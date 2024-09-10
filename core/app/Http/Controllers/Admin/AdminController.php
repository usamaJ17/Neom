<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Room;
use App\Models\NewBedType;
use App\Models\RoomType;
use App\Models\BookedRoom;
use App\Models\Booking;
use App\Models\PaymentLog;
use App\Models\UserLogin;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Constants\Status;
use Illuminate\Support\Facades\Hash;
use App\Models\Accommodation;
use App\Models\Amenity;
use App\Models\Status as RoomStatus;
use App\Models\BedType;
use App\Models\LostFound;
use App\Models\FoundBy;
use App\Models\HandedBy;
use App\Models\HandedTo;
use DB;

class AdminController extends Controller {
    
     public function statusIndex() {
        $pageTitle = 'Bed Status';
        $statuses = RoomStatus::with('accommodation','room','room.room')->latest()->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        $accommodations = Accommodation::whereStatus(1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        return view('admin.status.index',compact('statuses','pageTitle','accommodations'));
    }
    public function statusSave($id=null) {
        $check = RoomStatus::whereRoomId(request()->room_id)->first();
        if($check){
            $check->update(request()->all());
            $notify[] = ['success', 'Bed Status Updated Successfully'];
        }else{
            RoomStatus::create(request()->all());
            $notify[] = ['success', 'Bed Status Added Successfully'];
        }
        return back()->withNotify($notify);
    }
    
    public function dashboard() {
       
        $pageTitle                          = 'Dashboard';
        // $todaysBookedRoomIds                = BookedRoom::active()->where('booked_for', todaysDate())->pluck('room_id')->toArray();
        $todaysBookedRoomIds                = BookedRoom::active()->when(auth()->guard('admin')->user()->accommodation_id,function($q){
                $q->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            })->pluck('room_id')->toArray();
        $widget['occupiedBedsId']           = Room::active()->whereIn('id',$todaysBookedRoomIds)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        $widget['newbedtypes']           = NewBedType::with('beds','beds.roomKey')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
       
        // $widget['today_booked']             = count($todaysBookedRoomIds);
        $widget['today_booked']             = $widget['occupiedBedsId'];
        
        $widget['today_available']          = Room::active()->whereNotIn('id', $todaysBookedRoomIds)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        $widget['total']                    = Booking::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('bookedRooms',function($query){
                $query->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            });
        })->count();
        $widget['active']                   = Booking::active()->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('bookedRooms',function($query){
                $query->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            });
        })->count();        
        $widget['pending_checkin']          = Booking::active()->KeyNotGiven()->whereDate('check_in', '<=', now())->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('bookedRooms',function($query){
                $query->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            });
        })->count();
        $widget['delayed_checkout']         = Booking::delayedCheckout()->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('bookedRooms',function($query){
                $query->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            });
        })->count();
        $widget['upcoming_checkin']         = Booking::active()->whereDate('check_in', '>', now())->whereDate('check_in', '<=', now()->addDays(gs('upcoming_checkin_days')))->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('bookedRooms',function($query){
                $query->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            });
        })->count();
        $widget['upcoming_checkout']        = Booking::active()->whereDate('check_out', '>', now())->whereDate('check_out', '<=', now()->addDays(gs('upcoming_checkout_days')))->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('bookedRooms',function($query){
                $query->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            });
        })->count();

        $widget['total_users']              = User::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        $widget['verified_users']           = User::active()->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        $widget['email_unverified_users']   = User::emailUnverified()->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        $widget['mobile_unverified_users']  = User::mobileUnverified()->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        
        $widget['amenities']                = Amenity::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        $widget['rooms']                    = BedType::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        $widget['beds']                     = Room::active()->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->count();
        $widget['vacant_beds']              = $widget['today_available'];
        
        $widget['vacant_rooms']              = 0;
        
        // $rooms              = BedType::with('beds')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
        //     $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        // })->get();
        
           $rooms = BedType::with(['beds' => function ($query) {
                $query->active(); 
            }])
            ->when(auth()->guard('admin')->user()->accommodation_id, function ($query) {
                $query->where('accommodation_id', auth()->guard('admin')->user()->accommodation_id);
            })
            ->get();
            foreach ($rooms as $room) {
               
                $hasBookedBed = $room->beds->contains(function ($bed) use ($todaysBookedRoomIds) {
                    
                    return in_array($bed->id, $todaysBookedRoomIds);
                });
            
                if (!$hasBookedBed) {
                    $widget['vacant_rooms'] += 1;
                }
            }
      
        // foreach($rooms as $room){
        //         $has = false;
        //     foreach($room->beds()->active()->get() as $bed){
        //         if(in_array($bed->id,$todaysBookedRoomIds)){
        //             $has = true;
        //         }
        //     }
        //         if(!$has){
        //             $widget['vacant_rooms'] += 1;
        //         }
        // }
     
        $roomTypesWithCounts = RoomType::withCount('rooms')->with('accommodation')
                    ->join('accommodations', 'room_types.accommodation_id', '=', 'accommodations.id')
                    ->orderBy('room_types.accommodation_id')
                    ->when(auth()->guard('admin')->user()->accommodation_id,function($q){
                            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                        })->get(['room_types.*', 'accommodations.name as accommodation_name']);
       

        $userLoginData                     = UserLogin::where('created_at', '>=', now()->subDay(30))->get(['browser', 'os', 'country']);
        $chart['user_browser_counter']     = $userLoginData->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_os_counter']          = $userLoginData->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_country_counter']     = $userLoginData->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);


        // Monthly Booking
        $report['months']                = collect([]);
        $report['booking_month_amount']  = collect([]);
        $report['booking_cancel_amount'] = collect([]);

        $bookingMonth  = BookedRoom::where('booked_for', '>=', now()->subYear())
            ->whereIn('status', [Status::ROOM_ACTIVE, Status::ROOM_CHECKOUT])
            ->selectRaw("SUM( CASE WHEN status IN(1,9) THEN fare END) as bookingAmount")
            ->selectRaw("DATE_FORMAT(booked_for,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->when(auth()->guard('admin')->user()->accommodation_id,function($q){
                $q->whereHas('room',function($qry){
                    $qry->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
                });
            })
            ->get();

        $bookingMonth->map(function ($bookingData) use ($report) {
            $report['months']->push($bookingData->months);
            $report['booking_month_amount']->push(getAmount($bookingData->bookingAmount));
        });


        $trxReport['date'] = collect([]);

        $plusTrx = PaymentLog::where('type', 'RECEIVED')->where('created_at', '>=', now()->subDays(30))
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%Y-%m-%d') as date")
            ->orderBy('created_at')
            ->groupBy('date')
            ->get();

        $plusTrx->map(function ($trxData) use ($trxReport) {
            $trxReport['date']->push($trxData->date);
        });

        $minusTrx = PaymentLog::where('type', 'RETURNED')->where('created_at', '>=', now()->subDays(30))
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%Y-%m-%d') as date")
            ->orderBy('created_at')
            ->groupBy('date')
            ->get();

        $minusTrx->map(function ($trxData) use ($trxReport) {
            $trxReport['date']->push($trxData->date);
        });

        $trxReport['date'] = dateSorting($trxReport['date']->unique()->toArray());
        $months            = $report['months'];

        for ($i = 0; $i < $months->count(); ++$i) {
            $monthVal      = Carbon::parse($months[$i]);
            if (isset($months[$i + 1])) {
                $monthValNext = Carbon::parse($months[$i + 1]);
                if ($monthValNext < $monthVal) {
                    $temp = $months[$i];
                    $months[$i]   = Carbon::parse($months[$i + 1])->format('F-Y');
                    $months[$i + 1] = Carbon::parse($temp)->format('F-Y');
                } else {
                    $months[$i]   = Carbon::parse($months[$i])->format('F-Y');
                }
            }
        }
    
    $accommodations = Accommodation::with('guests','newBedTypes')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        
        $currentMonth = Carbon::now()->format('F');
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
        $today = Carbon::today()->toDateString();
        
        $monthlyCheckins = DB::table('bookings')
        ->where('status', 1)
        ->whereBetween('checked_in_at', [$startOfMonth, $endOfMonth])
        ->when(auth()->guard('admin')->user()->accommodation_id,function($q){
                    $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
               
            })
        ->count();
        
         $monthlyCheckouts = DB::table('bookings')
        ->where('status', 9)
        ->whereBetween('checked_out_at', [$startOfMonth, $endOfMonth])
        ->when(auth()->guard('admin')->user()->accommodation_id,function($q){
                    $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
               
            })
        ->count();
        
        $dailyCheckins = DB::table('bookings')
            ->where('status', 1) 
            ->whereDate('checked_in_at', $today)
            ->when(auth()->guard('admin')->user()->accommodation_id,function($q){
                    $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
            })
            ->count();
            
            $dailyCheckouts = DB::table('bookings')
            ->where('status', 9) 
            ->whereDate('checked_out_at', $today)
            ->when(auth()->guard('admin')->user()->accommodation_id,function($q){
                    $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
               
            })
            ->count();

    return view('admin.dashboard', compact('pageTitle', 'widget', 'chart', 'bookingMonth', 'months', 'trxReport', 'plusTrx', 'minusTrx', 'roomTypesWithCounts','accommodations', 'currentMonth', 'monthlyCheckins', 'monthlyCheckouts','dailyCheckins', 'dailyCheckouts'));

    }
    
    
     public function getDashboardData(Request $request)
    {
       $accommodation = Accommodation::find(auth()->guard('admin')->user()->accommodation_id);
        
         if (!empty($accommodation))
        {
            $amenities              = Amenity::where('accommodation_id',$accommodation->id)->count();
            $rooms                  = BedType::where('accommodation_id',$accommodation->id)->count();
            $beds                   = Room::active()->where('accommodation_id',$accommodation->id)->count();
            $todaysBookedRoomIds    = BookedRoom::active()->where('accommodation_id', $accommodation->id)->pluck('room_id')->toArray();
            $today_booked           = Room::active()->where('accommodation_id',$accommodation->id)->whereIn('id',$todaysBookedRoomIds)->count();
            $today_available        = Room::active()->whereNotIn('id', $todaysBookedRoomIds)->where('accommodation_id', $accommodation->id)->count();
            $active                 = Booking::active()->where('accommodation_id', $accommodation->id)->when($request->created_at,function($query) use ($request){
                                        $query->where(function ($q) use ($request) {
                                        $date = \Carbon\Carbon::parse($request->created_at)->format('Y-m-d');
                                         $q->where('check_in',$date)->orWhere('check_out','<=',$date);
                                        });
                                        })->count();
            $total                  = Booking::where('accommodation_id', $accommodation->id)->when($request->created_at,function($query) use ($request){
                                        $query->where(function ($q) use ($request) {
                                        $date = \Carbon\Carbon::parse($request->created_at)->format('Y-m-d');
                                         $q->where('check_in',$date)->orWhere('check_out','<=',$date);
                                        });
                                        })->count();
            $pending_checkin        = Booking::active()->KeyNotGiven()->whereDate('check_in', '<=', now())->where('accommodation_id', $accommodation->id)->count();
            $delayed_checkout       = Booking::delayedCheckout()->where('accommodation_id', $accommodation->id)->count();
            $upcoming_checkin       = Booking::active()->whereDate('check_in', '>', now())->whereDate('check_in', '<=', now()->addDays(gs('upcoming_checkin_days')))->where('accommodation_id', $accommodation->id)->count();
            $upcoming_checkout      = Booking::active()->whereDate('check_out', '>', now())->whereDate('check_out', '<=', now()->addDays(gs('upcoming_checkout_days')))->where('accommodation_id', $accommodation->id)->count();
            $occupiedBedsId         = Room::active()->where('accommodation_id',$accommodation->id)->whereIn('room_id',$todaysBookedRoomIds)->count();
            $vacant_beds            = $today_available;
            $vacant_rooms           = 0;
            $total_rooms            = BedType::with(['beds' => function ($query) {
                $query->active(); 
            }])
            ->where('accommodation_id',$accommodation->id)->get();
            foreach ($rooms as $room) {
               
                $hasBookedBed = $room->beds->contains(function ($bed) use ($todaysBookedRoomIds) {
                    
                    return in_array($bed->id, $todaysBookedRoomIds);
                });
            
                if (!$hasBookedBed) {
                    $widget['vacant_rooms'] += 1;
                }
            }
            
            // $total_rooms              = BedType::with('beds')->where('accommodation_id',$accommodation->id)->get();
            //         foreach($total_rooms as $room){
            //                 $has = false;
            //             foreach($room->beds()->active()->get() as $bed){
            //                 if(in_array($bed->id,$todaysBookedRoomIds)){
            //                     $has = true;
            //                 }
            //             }
            //                 if(!$has){
            //                     $vacant_rooms += 1;
            //                 }
            //         }
            
             $roomTypesWithCounts = RoomType::withCount('rooms')->with('accommodation')
            ->where('accommodation_id', $accommodation->id)
            ->get();
            
            $newbedtypes           = NewBedType::with('beds','beds.roomKey')->where('accommodation_id', $accommodation->id)->get();
            $bed_types_data = '';
            
            foreach($newbedtypes as $type){
                $bed_types_data .= '<div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">'.$type->beds->count().'</h3>
                             <p>Bed Type '.$type->name.'</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            }
       $bed_types_data .= '<hr/><div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Bed Key</h5>
                </div>
            </div>
        </div>';
        $total_key = 0;
        foreach($newbedtypes as $type){
            $total_key += $type->beds()->has('roomKey')->count();
            $bed_types_data .= '<div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">'.$type->beds()->has('roomKey')->count().'</h3>
                             <p>Bed '.$type->name.' Key</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        
        $bed_types_data .='<div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">'.$total_key.'</h3>
                             <p>Total Bed Key</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        
        
        $accommodation_types_data = '<div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="fas fa-users icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="mb-0">'.$accommodation->guests->count().' Guests</h3>
                             <p>'.$accommodation->name.'</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            
        }else{
            $amenities              = Amenity::count();
            $rooms                  = Room::active()->count();
            
            $beds                   = BedType::count();
            $todaysBookedRoomIds    = BookedRoom::active()->pluck('room_id')->toArray();
            $today_booked           = Room::active()->whereIn('id',$todaysBookedRoomIds)->count();
            $today_available        = Room::active()->whereNotIn('id', $todaysBookedRoomIds)->count();
            $active                 = Booking::active()->when($request->created_at,function($query) use ($request){
                                        $query->where(function ($q) use ($request) {
                                        $date = \Carbon\Carbon::parse($request->created_at)->format('Y-m-d');
                                         $q->where('check_in',$date)->orWhere('check_out','<=',$date);
                                        });
                                        })->count();
            $total                  = Booking::when($request->created_at,function($query) use ($request){
                                        $query->where(function ($q) use ($request) {
                                        $date = \Carbon\Carbon::parse($request->created_at)->format('Y-m-d');
                                         $q->where('check_in',$date)->orWhere('check_out','<=',$date);
                                        });
                                        })->count();
            $pending_checkin        = Booking::active()->KeyNotGiven()->whereDate('check_in', '<=', now())->count();
            $delayed_checkout       = Booking::delayedCheckout()->count();
            $upcoming_checkin       = Booking::active()->whereDate('check_in', '>', now())->whereDate('check_in', '<=', now()->addDays(gs('upcoming_checkin_days')))->count();
            $upcoming_checkout      = Booking::active()->whereDate('check_out', '>', now())->whereDate('check_out', '<=', now()->addDays(gs('upcoming_checkout_days')))->count();
            $occupiedBedsId         = Room::active()->whereIn('room_id',$todaysBookedRoomIds)->count();
            $vacant_beds            = $today_available;
            
            $vacant_rooms           = 0;
            $total_rooms            = BedType::with(['beds' => function ($query) {
                                            $query->active(); 
                                        }])->get();
                                        
                                        
            foreach ($rooms as $room) {
               
                $hasBookedBed = $room->beds->contains(function ($bed) use ($todaysBookedRoomIds) {
                    
                    return in_array($bed->id, $todaysBookedRoomIds);
                });
            
                if (!$hasBookedBed) {
                    $widget['vacant_rooms'] += 1;
                }
            }
            // $total_rooms              = BedType::with('beds')->get();
            //         foreach($total_rooms as $room){
            //                 $has = false;
            //           foreach($room->beds()->active()->get() as $bed){
            //                 if(in_array($bed->id,$todaysBookedRoomIds)){
            //                     $has = true;
            //                 }
            //             }
            //                 if(!$has){
            //                     $vacant_rooms += 1;
            //                 }
            //         }
            
             $roomTypesWithCounts = RoomType::withCount('rooms')->with('accommodation')
            ->get();
            
            $newbedtypes           = NewBedType::with('beds','beds.roomKey')->get();
            $bed_types_data = '';
            
            foreach($newbedtypes as $type){
                $bed_types_data .= '<div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">'.$type->beds->count().'</h3>
                             <p>Bed Type '.$type->name.'</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            }
            $bed_types_data .= '<hr/><div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Bed Key</h5>
                </div>
            </div>
        </div>';
            
        $total_key = 0;
        foreach($newbedtypes as $type){
            $total_key += $type->beds()->has('roomKey')->count();
            $bed_types_data .= '<div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">'.$type->beds()->has('roomKey')->count().'</h3>
                             <p>Bed '.$type->name.' Key</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        
        $bed_types_data .='<div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">'.$total_key.'</h3>
                             <p>Total Bed Key</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        
        $accommodations = Accommodation::with('guests')->get();
        
        $accommodation_types_data='';
        
        foreach($accommodations as $accommodation){
        $accommodation_types_data .= '<div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5 border border--success text--success">
                            <i class="fas fa-users icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="mb-0">'.$accommodation->guests->count().' Guests</h3>
                             <p>'.$accommodation->name.'</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        
        }
        
        return response()->json(['amenities'=>$amenities, 'rooms'=> $rooms, 'today_booked'=> $today_booked, 'today_available'=> $today_available, 'active'=>$active, 'total'=> $total,'pending_checkin'=>$pending_checkin,'delayed_checkout'=>$delayed_checkout,'upcoming_checkin'=>$upcoming_checkin,'upcoming_checkout'=>$upcoming_checkout,'beds'=>$beds,'occupiedBedsId'=>$occupiedBedsId,'vacant_beds'=>$vacant_beds,'vacant_rooms'=>$vacant_rooms, 'roomTypesWithCounts'=>$roomTypesWithCounts,'bed_types_data' => $bed_types_data,'accommodation_types_data' => $accommodation_types_data ]);
       
    }


    public function profile() {
        $pageTitle = 'Profile';
        $admin = auth('admin')->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
        ]);
        $user = auth('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Profile updated successfully'];
        return to_route('admin.profile')->withNotify($notify);
    }


    public function password() {
        $pageTitle = 'Password Setting';
        $admin = auth('admin')->user();
        return view('admin.password', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request) {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = auth('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password doesn\'t match!!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return to_route('admin.password')->withNotify($notify);
    }

    public function notifications() {
        $notifications = AdminNotification::orderBy('id', 'desc')->with('user')->paginate(getPaginate());
        $pageTitle = 'Notifications';
        return view('admin.notifications', compact('pageTitle', 'notifications'));
    }

    public function notificationRead($id) {
        $notification = AdminNotification::findOrFail($id);
        $notification->is_read = Status::YES;
        $notification->save();
        $url = $notification->click_url;
        if ($url == '#') {
            $url = url()->previous();
        }
        return redirect($url);
    }

    public function requestReport() {
        return abort(404);
        $pageTitle = 'Your Listed Report & Request';
        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['PURCHASECODE'] = env('PURCHASECODE');
        $url = "https://license.viserlab.com/issue/get?" . http_build_query($arr);
        $response = CurlRequest::curlContent($url);
        $response = json_decode($response);
        if ($response->status == 'error') {
            return to_route('admin.dashboard')->withErrors($response->message);
        }
        $reports = $response->message[0];
        return view('admin.reports', compact('reports', 'pageTitle'));
    }

    public function reportSubmit(Request $request) {
        $request->validate([
            'type' => 'required|in:bug,feature',
            'message' => 'required',
        ]);
        $url = 'https://license.viserlab.com/issue/add';

        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['PURCHASECODE'] = env('PURCHASECODE');
        $arr['req_type'] = $request->type;
        $arr['message'] = $request->message;
        $response = CurlRequest::curlPostContent($url, $arr);
        $response = json_decode($response);
        if ($response->status == 'error') {
            return back()->withErrors($response->message);
        }
        $notify[] = ['success', $response->message];
        return back()->withNotify($notify);
    }

    public function readAll() {
        AdminNotification::where('is_read', Status::NO)->update([
            'is_read' => Status::YES
        ]);
        $notify[] = ['success', 'Notifications read successfully'];
        return back()->withNotify($notify);
    }


    public function downloadAttachment($fileHash) {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $title = slug(gs('site_name')) . '- attachments.' . $extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }
    
    
    
    public function lostFounditem (){
        $pageTitle = 'All Lost and found item';
        $data = LostFound::all();
         $foundby = FoundBy::all();
         $handedby = HandedBy::all();
         $handedto = HandedTo::all();
        return view ('admin.lostFounditem.index',compact ('pageTitle','data','foundby','handedby','handedto'));
    }
    public function lostFounditemcreate (){
        $pageTitle = 'Your Lost and found item';
        return view ('admin.lostFounditem.create',compact ('pageTitle'));
    }
    
    public function lostFounditemStore(Request $request)
    {
        $data = $request->all();
        LostFound::create($data);
        $notify[] = ['success', 'Lost Found Created Successfully !!!'];
        return redirect()->route('admin.lostFounditem')->withNotify($notify);
    }
    
    public function lostFounditemereport($id){
        
        $pageTitle = 'Lost and found report';
        $data = LostFound::findOrFail($id);
        return view ('admin.lostFounditem.report',compact ('pageTitle','data'));
    }
    
    public function lostFounditemeedit($id){
        
        $pageTitle = 'Your Lost and found item';
        $data = LostFound::findOrFail($id);
        return view ('admin.lostFounditem.edit',compact ('pageTitle','data'));
    }
    
    public function lostFounditemeUpdate(Request $request,$id)
    {
      
        LostFound::findOrFail($id)->update(request()->all());
        $notify[] = ['success', 'Lost Found Updated Successfully !!!'];
        return redirect()->route('admin.lostFounditem')->withNotify($notify);
    }
    
    
     public function lostFounditemeDelete($id)
    {
        $data = LostFound::findOrFail($id);
        $data->delete();
        $notify[] = ['success', 'Lost Found Deleted Successfully !!!'];
        return redirect()->route('admin.lostFounditem')->withNotify($notify);
    }
    
    
    
    public function foundBy(){
        $pageTitle = 'Your Found by item';
        $data = FoundBy::all();
        return view ('admin.foundBy.index',compact ('pageTitle','data'));
    }
    
    
    
    public function foundBycreate(){
        $pageTitle = 'Your Found by item Create';
        return view ('admin.foundBy.create',compact ('pageTitle'));
    }
    
    public function foundbyStore(Request $request){
        $pageTitle = 'Your Found by item Create';
        
        
        $data = request()->all();
        
        if ($image = $request->file('signature')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['signature'] = $profileImage;
        }
        
        FoundBy::create($data);
        $notify[] = ['success', 'Found By Created Successfully !!!'];
        return redirect()->route('admin.foundby')->withNotify($notify);
        
    }
    
    
    public function foundByedit($id){
        $pageTitle = 'Your Found by item Edit';
        $data = FoundBy::findOrFail($id);
        return view ('admin.foundBy.edit',compact ('pageTitle','data'));
    }
    
    public function foundbyUpdate(Request $request,$id){
        
        $pageTitle = 'Your Found by item Edit';
        $data = request()->all();
        
        if ($image = $request->file('signature')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['signature'] = $profileImage;
        }
        
        FoundBy::findOrFail($id)->update($data);
        $notify[] = ['success', 'Found By Updated Successfully !!!'];
        return redirect()->route('admin.foundby')->withNotify($notify);
        
    }
    public function foundByDelete(Request $request,$id){
        FoundBy::findOrFail($id)->delete();
        $notify[] = ['success', 'Found By Deleted Successfully !!!'];
        return back()->withNotify($notify);
    }
    
    
    
    
    public function handedOverBy (){
         $pageTitle = 'Your Handed Over By item ';
         $data = HandedBy::all();
        return view ('admin.handedOverBy.index',compact ('data','pageTitle'));
    }
    
    public function handedOverBycreate (){
         $pageTitle = 'Your Handed Over By item create';
        return view ('admin.handedOverBy.create',compact ('pageTitle'));
    }
      public function handedOverByStore(Request $request){
        $pageTitle = 'Your Found by item Create';
        
        
        $data = request()->all();
        
        if ($image = $request->file('signature')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['signature'] = $profileImage;
        }
        
        HandedBy::create($data);
        $notify[] = ['success', 'Found By Created Successfully !!!'];
        return redirect()->route('admin.handedOverBy')->withNotify($notify);
        
    }
    public function handedOverByedit ($id){
         $data = HandedBy::findOrFail($id);
         $pageTitle = 'Your Handed Over By item Edit';
        return view ('admin.handedOverBy.edit',compact ('pageTitle','data'));
    }
    
     public function handedOverByupdate(Request $request,$id){
        
        $pageTitle = 'Your Handed Over By item Edit';
        $data = request()->all();
        
        if ($image = $request->file('signature')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['signature'] = $profileImage;
        }
        
        HandedBy::findOrFail($id)->update($data);
        $notify[] = ['success', 'Handed Over By Updated Successfully !!!'];
        return redirect()->route('admin.handedOverBy')->withNotify($notify);
        
    }
    public function handedOverBydelete(Request $request,$id){
        HandedBy::findOrFail($id)->delete();
        $notify[] = ['success', 'Handed Over By Deleted Successfully !!!'];
        return back()->withNotify($notify);
    }
    
    
    
    
    
    public function handedOverto(){
         $data = HandedTo::all();
         $pageTitle = 'Your Handed Over to item Edit';
        return view ('admin.handedOverto.index',compact ('pageTitle','data'));
    }
    public function handedOvetocreate (){
         $pageTitle = 'Your Handed Over to item Edit';
        return view ('admin.handedOverto.create',compact ('pageTitle'));
    }
    public function handedOvetoStore (Request $request){
         $pageTitle = 'Your Handed Over to item Edit';
          
        
        
        $data = request()->all();
        
        if ($image = $request->file('signature')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['signature'] = $profileImage;
        }
        
        HandedTo::create($data);
        $notify[] = ['success', 'Handed Over to Created Successfully !!!'];
        return redirect()->route('admin.handedOverto')->withNotify($notify);
       
    }
    public function handedOvertoedit ($id){
        $data = HandedTo::findOrFail($id);
         $pageTitle = 'Your Handed Over to item Edit';
        return view ('admin.handedOverto.edit',compact ('pageTitle','data'));
    }
    public function handedOvertoUpdate(Request $request,$id){
         $pageTitle = 'Your Handed Over to item Edit';
        $data = request()->all();
        
        if ($image = $request->file('signature')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['signature'] = $profileImage;
        }
        
        HandedTo::findOrFail($id)->update($data);
        $notify[] = ['success', 'Handed Over to Updated Successfully !!!'];
        return redirect()->route('admin.handedOverto')->withNotify($notify);
    }
    public function handedOvertoDelete(Request $request,$id){
        HandedTo::findOrFail($id)->delete();
        $notify[] = ['success', 'Handed Over to Deleted Successfully !!!'];
        return back()->withNotify($notify);
    }
}
