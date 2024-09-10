<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\NotificationLog;
use App\Models\Booking;
use App\Models\BookedRoom;
use App\Models\BookingRequest;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Room;
use App\Models\Accommodation;
use App\Models\StaffTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ManageUsersController extends Controller {
    
    public function transferStaff(){
        $pageTitle = 'Transfer Guest';
        $transferStaff = StaffTransfer::with('preaccommodation','accommodation','user','admin')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->latest()->get();
        $accommodations = Accommodation::where('status',1)->get();
        $allStaff = User::with('accommodation')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        return view('admin.users.trasnferUser', compact('pageTitle', 'allStaff', 'transferStaff', 'accommodations'));
    }
    
    private function bookingGuest($booking) {
        if ($booking->user) {
            return $booking->user;
        }
        $guest = new User();
        $guest->username = $booking->guest_details->name;
        $guest->fullname = $booking->guest_details->name;
        $guest->mobile   = $booking->guest_details->mobile;

        return $guest;
    }
    
    public function transferSave(Request $request, $id = 0) {
        
        
        $request->validate([
            'staff_id'                  => 'required',
            'transfer_date'             => 'required',
            ]);
            
        $staff = User::where('id', $request->staff_id)->first();
        
        if($request->booking_id){
            $staff_transfer = StaffTransfer::create([
                    'booking_id'  => $request->booking_id,
                    'previous_accommodation'  => $staff->accommodation_id,
                    'accommodation_id'           => $staff->accommodation_id,
                    'transfer_date'      => date('Y-m-d H:i:s',strtotime($request->transfer_date)),
                    'staff_id'           => $request->staff_id,
                    'transfer_by'        => auth()->guard('admin')->user()->id,
                    'created_at'         => date('Y-m-d H:i:s'),
                    'updated_at'         => date('Y-m-d H:i:s'),
                ]);
                
        $booking     = Booking::active()->findOrFail($request->booking_id);
        $bookedRooms = BookedRoom::active()->where('booking_id', $booking->id);

        $booking->cancellation_fee += (clone $bookedRooms)->sum('cancellation_fee');
        $booking->booking_fare  -= (clone $bookedRooms)->sum('fare');
        $booking->tax_charge -= (clone $bookedRooms)->sum('tax_charge');
        $booking->status = Status::BOOKING_CANCELED;
        $booking->save();

        $roomIds =  $booking->bookedRooms()->pluck('room_id')->toArray();
        $rooms   = Room::whereIn('id', $roomIds)->get()->pluck('room_number')->toArray();
        $bookedRooms->update(['status' => Status::ROOM_CANCELED]);

        notify($this->bookingGuest($booking), 'BOOKING_CANCELED', [
            'booking_number' => $booking->booking_number,
            'rooms'          => implode(', ', $rooms),
            'check_in'       => Carbon::parse($booking->bookedRooms->first()->booked_for)->format('d M, Y'),
            'check_out'      => Carbon::parse($booking->bookedRooms->last()->booked_for)->format('d M, Y')
        ]);

        $booking->createActionHistory('cancel_booking');

        }else{
            
        $staff_transfer = StaffTransfer::create([
                    'previous_accommodation'  => $staff->accommodation_id,
                    'accommodation_id'           => $request->accommodation_id,
                    'transfer_date'      => date('Y-m-d H:i:s',strtotime($request->transfer_date)),
                    'staff_id'           => $request->staff_id,
                    'transfer_by'        => auth()->guard('admin')->user()->id,
                    'created_at'         => date('Y-m-d H:i:s'),
                    'updated_at'         => date('Y-m-d H:i:s'),
                ]);
        $staff->update([
            'accommodation_id'=>$request->accommodation_id
        ]);
        
        }
        
        if($request->type){
            $staff_transfer->is_booked = 0;
            $staff_transfer->save();
            $notify[] = ['success', 'Guest Transferred Successfully'];
            return back()->withNotify($notify);
        }
        return redirect('admin/book-room/?user_id='.$staff->id.'&accommodation_id='.$staff->accommodation_id);
    }
    
    public function allUsers() {
        $pageTitle = 'All Guests';
        $users = $this->userData();
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function activeUsers() {
        $pageTitle = 'Active Guests';
        $users = $this->userData('active');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function bannedUsers() {
        $pageTitle = 'Banned Guests';
        $users = $this->userData('banned');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function emailUnverifiedUsers() {
        $pageTitle = 'Email Unverified Guests';
        $users = $this->userData('emailUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function emailVerifiedUsers() {
        $pageTitle = 'Email Verified Guests';
        $users = $this->userData('emailVerified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function mobileUnverifiedUsers() {
        $pageTitle = 'Mobile Unverified Guests';
        $users = $this->userData('mobileUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function mobileVerifiedUsers() {
        $pageTitle = 'Mobile Verified Guests';
        $users = $this->userData('mobileVerified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    protected function userData($scope = null) {
        if ($scope) {
            $users = User::$scope();
        } else {
            $users = User::query();
        }
        return $users->with('accommodation')->searchable(['username', 'email'])->orderBy('id', 'desc')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
    }

    public function detail($id) {
        $user                        = User::findOrFail($id);
        $pageTitle                   = 'Details of ' . $user->username;
        $widget['total_bookings']    = Booking::where('user_id', $id)->count();
        $widget['running_bookings']  = Booking::active()->where('user_id', $id)->count();
        $widget['booking_requests']  = BookingRequest::initial()->where('user_id', $id)->count();
        $widget['total_payment']     = Deposit::successful()->where('user_id', $id)->sum('amount');
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view('admin.users.detail', compact('pageTitle', 'user', 'countries', 'widget'));
    }

    public function update(Request $request, $id) {
        $user           = User::findOrFail($id);
        $countryData    = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryArray   = (array) $countryData;
        $countries      = implode(',', array_keys($countryArray));
        $countryCode    = $request->country;
        $country        = $countryData->$countryCode->country;
        $dialCode       = $countryData->$countryCode->dial_code;

        $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'mobile'    => ['regex:/^([0-9]*)$/', 'unique:users,mobile,' . $user->id],
            'country'   => 'required|in:' . $countries,
        ]);


        if (preg_match("/[^a-z0-9_]/", trim($request->username))) {
            $notify[] = ['info', 'Username can contain only small letters, numbers and underscore.'];
            $notify[] = ['error', 'No special character, space or capital letters in username.'];
            return back()->withNotify($notify)->withInput($request->all());
        }

        $countryCode        = $request->country;
        $user->mobile       = $dialCode . $request->mobile;
        $user->country_code = $countryCode;
        $user->firstname    = $request->firstname;
        $user->lastname     = $request->lastname;
        $user->email        = $request->email;
        $user->address      = [
            'address'       => $request->address,
            'city'          => $request->city,
            'state'         => $request->state,
            'zip'           => $request->zip,
            'country'       =>  @$country,
        ];
        $user->ev = $request->ev ? Status::VERIFIED : Status::UNVERIFIED;
        $user->sv = $request->sv ? Status::VERIFIED : Status::UNVERIFIED;
        $user->save();

        $notify[] = ['success', 'User detail updated successfully'];
        return back()->withNotify($notify);
    }

    public function login($id) {
        Auth::loginUsingId($id);
        return to_route('user.home');
    }

    public function status(Request $request, $id) {
        $user = User::findOrFail($id);
        if ($user->status == Status::USER_ACTIVE) {
            $request->validate([
                'reason' => 'required|string|max:255'
            ]);
            $user->status = Status::USER_BAN;
            $user->ban_reason = $request->reason;
            $notify[] = ['success', 'User banned successfully'];
        } else {
            $user->status = Status::USER_ACTIVE;
            $user->ban_reason = null;
            $notify[] = ['success', 'User unbanned successfully'];
        }
        $user->save();
        return back()->withNotify($notify);
    }


    public function showNotificationSingleForm($id) {
        $user = User::findOrFail($id);
        if (!gs('en') && !gs('sn')) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.users.detail', $user->id)->withNotify($notify);
        }
        $pageTitle = 'Send Notification to ' . $user->username;
        return view('admin.users.notification_single', compact('pageTitle', 'user'));
    }

    public function sendNotificationSingle(Request $request, $id) {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        notify($user, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $notify[] = ['success', 'Notification sent successfully'];
        return back()->withNotify($notify);
    }

    public function showNotificationAllForm() {
        if (!gs('en') && !gs('sn')) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.dashboard')->withNotify($notify);
        }
        $users = User::where('ev', 1)->where('status', 1)->count();
        $pageTitle = 'Notification to Verified Guests';
        return view('admin.users.notification_all', compact('pageTitle', 'users'));
    }

    public function sendNotificationAll(Request $request) {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'subject' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $user = User::active()->skip($request->skip)->first();

        if (!$user) {
            return response()->json([
                'error' => 'User not found',
                'total_sent' => 0,
            ]);
        }

        notify($user, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => 'message sent',
            'total_sent' => $request->skip + 1,
        ]);
    }

    public function notificationLog($id) {
        $user      = User::findOrFail($id);
        $pageTitle = 'Notifications Sent to ' . $user->username;
        $logs      = NotificationLog::where('user_id', $id)->with('user')->orderBy('id', 'desc')->get();
        return view('admin.reports.notification_history', compact('pageTitle', 'logs', 'user'));
    }
    
    public function create(){
         $pageTitle   = 'Add Guest';
       
         $accommodations = Accommodation::where('status', 1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
      
        return view('admin.users.create', compact('pageTitle','accommodations'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the form data
        $validatedData = $request->validate([
            'firstname'        => 'required|string|max:255',
            'lastname'         => 'required|string|max:255',
            'username'          => 'required|string|unique:users|max:10',
            'email'             => 'required|email|unique:users|max:255',
            'nationality'       => 'required|string|max:255',
            'passport_no'       => 'required|string|max:255',
            'gender'            => 'required|in:male,female',
            'department'        => 'required|string|max:255',
            'designation'       => 'required|string|max:255',
            'category'          => 'required|string|max:255',
            'contact_number'    => 'required|string|max:20',
            'company'      => 'required|string|max:255',
            'project'      => 'required|string|max:255',
            'remarks'           => 'nullable|string',
            'country_code'      => 'required|string|max:10',
            'address'           => 'nullable|string',
            'password'          => 'required|string|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
        $notify[] = ['success', 'Guest add successfully'];
        return back()->withNotify($notify);
    }
}
