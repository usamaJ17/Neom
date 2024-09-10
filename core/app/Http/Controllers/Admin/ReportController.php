<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingActionHistory;
use App\Models\Booking;
use App\Models\NewBedType;
use App\Models\NotificationLog;
use App\Models\UserLogin;
use App\Models\PaymentLog;
use App\Models\Accommodation;
use App\Models\BookedRoom;
use App\Models\BedType;
use App\Models\Room;
use App\Models\HandedTo;
use App\Models\HandedBy;
use App\Models\FoundBy;
use App\Models\LostFound;
use Illuminate\Http\Request;

class ReportController extends Controller {
    
    public function booking_report() {
        $pageTitle = 'Booking Reports';
        $bookings = $this->bookingData('ALL');
        return view('admin.reports.booking', compact('pageTitle', 'bookings'));
    }
    
    protected function bookingData($scope) {
        $query = Booking::query()->with('accommodation')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('bookedRooms',function($query){
                $query->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            });
        });

        if ($scope != "ALL") {
            $query = $query->$scope();
        }

        $request = request();
          
        if ($request->search) {
            $search = $request->search;
            $query = $query->where(function ($q) use ($search) {
                $q->where('booking_number', $search)
                    ->orWhere(function ($q) use ($search) {
                        $q->whereHas('user', function ($user) use ($search) {
                            $user->where('username', 'like', "%$search%")
                                ->orWhere('email', 'like', "%$search%");
                        })
                            ->orWhere('guest_details->name', 'like', "%$search%")
                            ->orWhere('guest_details->email', 'like', "%$search%");
                    });
            });
        }

        if ($request->check_in) {
            $query = $query->whereDate('check_in', $request->check_in);
        }
        if ($request->check_out) {
            $query = $query->whereDate('check_out', $request->check_out);
        }
      
        return $query->with('bookedRooms.room', 'user', 'activeBookedRooms', 'activeBookedRooms.room:id,room_number')
            ->withSum('usedExtraService', 'total_amount')
            ->latest()
            ->orderBy('check_in', 'asc')
            ->get();
    }
    
    public function loginHistory(Request $request) {
        $pageTitle = 'Guests Login History';
        $loginLogs = UserLogin::orderBy('id', 'desc')->searchable(['user:username'])->with('user')->get();
        return view('admin.reports.logins', compact('pageTitle', 'loginLogs'));
    }

    public function loginIpHistory($ip) {
        $pageTitle = 'Login by - ' . $ip;
        $loginLogs = UserLogin::where('user_ip', $ip)->orderBy('id', 'desc')->with('user')->get();
        return view('admin.reports.logins', compact('pageTitle', 'loginLogs', 'ip'));
    }

    public function notificationHistory(Request $request) {
        $pageTitle = 'Notification History';
        $logs = NotificationLog::orderBy('id', 'desc')->searchable(['user:username'])->with('user')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('user',function($query){
            $query->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
            });
        })->get();
        return view('admin.reports.notification_history', compact('pageTitle', 'logs'));
    }

    public function emailDetails($id) {
        $pageTitle = 'Email Details';
        $email = NotificationLog::findOrFail($id);
        return view('admin.reports.email_details', compact('pageTitle', 'email'));
    }


    public function bookingSituationHistory() {
        $pageTitle  = 'Booking Situation Report';
        $remarks    = BookingActionHistory::groupBy('remark')->orderBy('remark')->get('remark');
        $query      = BookingActionHistory::searchable(['booking:booking_number'])->filter(['remark']);
        $bookingLog = $query->with('booking', 'admin')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('booking',function($qr){
            $qr->whereHas('bookedRooms',function($query){
                $query->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            });
            });
        })->orderBy('id', 'desc')->get();
        return view('admin.reports.booking_actions', compact('pageTitle', 'bookingLog', 'remarks'));
    }

    public function paymentsReceived() {
        return $this->getPaymentData('RECEIVED', 'Received Payments History');
    }

    public function paymentReturned() {
        return $this->getPaymentData('RETURNED', 'Returned Payments History');
    }

    protected function getPaymentData($type, $pageTitle) {
        $paymentLog = PaymentLog::where('type', $type)->searchable(['booking:booking_number', 'booking.user:username'])->with('booking.user', 'admin')->orderBy('id', 'desc')->get();

        return view('admin.reports.payment_history', compact('pageTitle', 'paymentLog', 'pageTitle'));
    }
    
         public function bed_count_report(){
                $pageTitle = 'Accommodation Beds Details';
            $accommodations = Accommodation::when(auth()->guard('admin')->user()->accommodation_id,function($q){
                    $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
            $bed_reports = array();
            foreach ($accommodations as $accommodation) {
                
                $booked_rooms           = BookedRoom::active()->where('accommodation_id', $accommodation->id)->pluck('room_id')->toArray();
                $occupied_beds    = Room::where('accommodation_id', $accommodation->id)->whereIn('room_id',$booked_rooms)->get();
                $occupied_beds_count    = Room::whereIn('room_id',$booked_rooms)->where('accommodation_id', $accommodation->id)->count();
                $beds       = Room::where('accommodation_id', $accommodation->id)->get();
                $total_beds_count       = Room::where('accommodation_id', $accommodation->id)->count();
                $vacant_beds_count      = $total_beds_count - $occupied_beds_count;
                $bed_types = NewBedType::whereAccommodationId($accommodation->id)->get();

                 $bed_reports[] = [
                    'accommodation' => $accommodation->name,
                    'beds'    => $beds,
                    'occupieds'    => $occupied_beds,
                    'total_beds'    => $total_beds_count,
                    'occupied_beds' => $occupied_beds_count,
                    'vacant_beds'   => $vacant_beds_count,
                    'bed_types'   => $bed_types,
                ];
            }
        

        return view('admin.reports.bed_count_report', compact('pageTitle','bed_reports'));

    }
    public function lost_found_report(){
        $pageTitle = 'Lost & Found Reports';
        
        $lost_found = LostFound::all();
        $founded_by = FoundBy::all();
        $handed_over_by = HandedBy::all();
        $handed_over_to = HandedTo::all();

        return view('admin.reports.lost_found_report', compact('pageTitle','lost_found','founded_by','handed_over_by','handed_over_to'));

    }
}
