<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookedRoom;
use App\Models\RoomType;
use App\Models\Accommodation;
use App\Models\Room;
use App\Models\User;
use App\Traits\BookingActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Hash;
class BookRoomController extends Controller {
    use BookingActions;

    public function room() {
        $pageTitle = 'Book Room';
        $roomTypes = RoomType::active()->get(['id', 'name']);
        $accommodations = Accommodation::where('status', 1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get(['id', 'name']);
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view('admin.booking.book', compact('pageTitle', 'roomTypes', 'countries', 'accommodations'));
    }

    function searchRoom(Request $request) {

        $validator = Validator::make($request->all(), [
            'accommodation' => 'required',
            'room_type' => 'required|exists:room_types,id',
            'bed_type_id' => 'required|exists:new_bed_types,id',
            'date' => 'required|string',
            'rooms' => 'required|integer|gt:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $date = explode('-', $request->date);

        // $request->merge([
        //     'checkin_date'  => trim(@$date[0]),
        //     'checkout_date' => trim(@$date[1]),
        // ]);
        
        $request->merge([
            'checkin_date'  => $request->date,
            'checkout_date' => Carbon::parse($request->date)->adddays(1),
        ]);

        // $validator = Validator::make($request->all(), [
        //     'checkin_date'  => 'required|date_format:m/d/Y|after:yesterday',
        //     'checkout_date' => 'required|date_format:m/d/Y|after:checkin_date',
        // ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $view = $this->getRooms($request);
        return response()->json(['html' => $view]);
    }

    public function book(Request $request) {
        
        // dd($request->all());
        if(!$request->user_id){
        
        
        $validator = Validator::make($request->all(), [
            'employee_id'    => 'nullable|required_if:guest_type,0',
            'car_no'    => 'nullable|required_if:guest_type,0',
            'accommodation'    => 'required|integer|gt:0',
            'room_type_id'    => 'required|integer|gt:0',
            'guest_type'      => 'required|in:1,0',
            'guest_name'      => 'nullable|required_if:guest_type,0',
            'user'      => 'nullable|required_if:guest_type,1',
            // 'email'           => 'required|email',
            'mobile'          => 'nullable|required_if:guest_type,0|regex:/^([0-9]*)$/',
            // 'address'         => 'nullable|required_if:guest_type,0|string',
            'nationality'     => 'nullable|required_if:guest_type,0|string',
            'passport'        => 'nullable|required_if:guest_type,0|string',
            'gender'         => 'nullable|required_if:guest_type,0|string',
            'department'         => 'nullable|required_if:guest_type,0|string',
            'designation'         => 'nullable|required_if:guest_type,0|string',
            'category'         => 'nullable|required_if:guest_type,0|string',
            'company'         => 'nullable|required_if:guest_type,0|string',
            // 'remarks'         => 'nullable|required_if:guest_type,0|string',
            'project'         => 'nullable|required_if:guest_type,0|string',
            // 'room'            => 'required|array',
            'room'              => 'required',
            'paid_amount'     => 'nullable|numeric|gte:0'
        ],[
            'user.required_if' => 'Please select a guest'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        if($request->guest_type == 1){
            $users = User::findOrFail($request->user);
        }
        
        }else{
            
             $validator = Validator::make($request->all(), [
            'accommodation'    => 'required|integer|gt:0',
            'room_type_id'    => 'required|integer|gt:0',
            // 'room'            => 'required|array',
            'room'            => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        
            $users = User::findOrFail($request->user_id);
        }
        
        $guest = [];

        // if ($request->guest_type == 1) {
        //     $user = User::where('email', $request->email)->first();
        //     if (!$user) {
        //         return response()->json(['error' => 'No registered guest found with this email']);
        //     }
        // } else {
            
            //  $users = User::where('email', $request->email)->first();
             
            if(!isset($users)){
               
                $users = new User();
                $users->employee_id = $request->employee_id;
                $users->car_no = $request->car_no;
                $users->firstname = $request->guest_name;
                $users->email = $request->email;
                $users->mobile = $request->mobile;
                $users->address = $request->address;
                $users->nationality = $request->nationality;
                $users->passport_no = $request->passport;
                $users->gender = $request->gender;
                $users->department = $request->department;
                $users->designation = $request->designation;
                $users->category = $request->category;
                $users->company = $request->company;
                $users->remarks = $request->remarks;
                $users->project = $request->project;
                $users->password = Hash::make('12345678');
                $users->username = strtolower(str_replace(' ', '', $request->guest_name) . '@00');
                $users->accommodation_id = $request->accommodation;
                $users->save();
                
            }
            
            
            $guest['name'] = $users->firstname;
            $guest['employee_id'] = $users->employee_id;
            $guest['car_no'] = $users->car_no;
            // $guest['email'] = $request->email;
            $guest['mobile'] = $users->mobile;
            // $guest['address'] = $request->address;
            $guest['nationality'] = $users->nationality;
            $guest['passport'] = $users->passport_no;
            $guest['gender'] = $users->gender;
            $guest['department'] = $users->department;
            $guest['designation'] = $users->designation;
            $guest['category'] = $users->category;
            $guest['company'] = $users->company;
            $guest['remarks'] = $users->remarks;
            $guest['project'] = $users->project;
        // }

        $bookedRoomData = [];
        $totalFare      = 0;
        $tax            = gs('tax');

        // foreach ($request->room as $room) {
        $room = $request->room;
            $data      = [];
            $roomId    = explode('-', $room)[0];
            $bookedFor = explode('-', $room)[1];
            $isBooked  = BookedRoom::where('room_id', $roomId)->where('booked_for', $bookedFor)->exists();

            if ($isBooked) {
                return response()->json(['error' => 'Room has been booked']);
            }

            $room = Room::with('room.roomType')->find($roomId);

            if ($request->room_type_id != @$room->room->roomType->id) {
                return response()->json(['error' => 'Invalid room type selected']);
            }
            
            $data['booking_id']       = 0;
            $data['accommodation_id']  = $room->accommodation_id;
            $data['room_type_id']  = $room->room->room_type_id;
            $data['room_id']          = $room->id;
            $data['booked_for']       = Carbon::parse($bookedFor)->format('Y-m-d');
            $data['fare']             = $room->room->roomType->fare;
            $data['tax_charge']       = $room->room->roomType->fare * $tax / 100;
            $data['cancellation_fee'] = $room->room->roomType->cancellation_fee;
            $data['status']           = Status::ROOM_ACTIVE;
            $data['created_at']       = now();
            $data['updated_at']       = now();

            $bookedRoomData[] = $data;

            $totalFare += $room->room->roomType->fare;
        // }


        $taxCharge = $totalFare * $tax / 100;

        if ($request->paid_amount && $request->paid_amount > $totalFare + $taxCharge) {
            return response()->json(['error' => 'Paying amount can\'t be greater than total amount']);
        }

        $booking                 = new Booking();
        $booking->booking_number = getTrx();
        $booking->user_id        = $users->id ?? 0;
        $booking->guest_details  = $guest;
        $booking->tax_charge     = $taxCharge;
        $booking->booking_fare   = $totalFare;
        $booking->paid_amount    = $request->paid_amount ?? 0;
        $booking->accommodation_id    = $request->accommodation;
        $booking->status         = Status::BOOKING_ACTIVE;
        $booking->save();

        if ($request->paid_amount) {
            $booking->createPaymentLog($booking->paid_amount, 'RECEIVED');
        }

        $booking->createActionHistory('book_room');

        foreach ($bookedRoomData as $key => $bookedRoom) {
            $bookedRoomData[$key]['booking_id'] = $booking->id;
        }

        BookedRoom::insert($bookedRoomData);

        $checkIn  = BookedRoom::where('booking_id', $booking->id)->min('booked_for');
        $checkout = BookedRoom::where('booking_id', $booking->id)->max('booked_for');

        $booking->check_in = $checkIn;
        $booking->check_out = Carbon::parse($checkout)->addDay()->toDateString();
        $booking->save();

           
        return response()->json(['success' => 'Room booked successfully']);
    }
    
    public function bookingCheckout(Request $request){
        
         $validator = Validator::make($request->all(), [
          
            'date' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        
        $checkout = Booking::find($request->id);
       
        if($checkout){
            $checkout->check_out = $request->date;
            $checkout->checked_out_at = $request->date;
            $checkout->save();
            return redirect()->back()->with('success', 'Checkout date change successfully');
        }
        return redirect()->back()->with('error', 'Data not found.');
        
    }
    
}
