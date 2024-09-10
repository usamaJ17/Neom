<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BedType;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomItem;
use App\Models\BookedRoom;
use App\Models\Accommodation;
use Illuminate\Validation\Rule;

class BedTypeController extends Controller {
    public function index() {
        // dd("Here");
        $pageTitle   = "Room List";
        $accommodations = Accommodation::where('status', 1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
         $roomTypes = RoomType::get();
        $roomItems = RoomItem::get();
        $bedTypes = BedType::with('roomType', 'roomItems','accommodation')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->latest()->get();
        
        if(request()->has('roomType') && request()->has('accommodation')){
            //  $bedTypes = BedType::with('roomType', 'roomItems', 'accommodation')
            //     ->where('accommodation_id', request()->accommodation_id)
            //     ->where('room_type_id', request()->roomType)
            //     ->latest()
            //     ->get();
            $bedTypes = BedType::with('roomType', 'roomItems', 'accommodation')
                    ->when(request()->has('accommodation_id'), function ($query) {
                        $query->where('accommodation_id', request()->accommodation_id);
                    })
                    ->when(request()->has('roomType'), function ($query) {
                        $query->where('room_type_id', request()->roomType);
                    })
                    ->latest()
                    ->get();
        }
        
        return view('admin.hotel.bed_type', compact('pageTitle','roomTypes','roomItems', 'accommodations','bedTypes'));
        
       
    }

    public function save(Request $request, $id = 0) {
        $request->validate([
            'bed_name' => 'required',
            'accommodation_id' => 'required',
            'room_type_id' => 'required',
            'roomitems' => 'required',
        ]);

        if ($id) {
            $bedType      = BedType::findOrFail($id);
            $notification = 'Room updated successfully';
        } else {
            $bedType      = new BedType();
            $notification = 'Room added successfully';
        }

        $bedType->bed_name = $request->bed_name;
        $bedType->accommodation_id = $request->accommodation_id;
        $bedType->room_type_id = $request->room_type_id;
        $bedType->roomitems = json_encode($request->roomitems);
        $bedType->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function delete($id) {
        BedType::findOrFail($id)->delete();
        $notify[] = ['success', 'Room deleted successfully'];
        return back()->withNotify($notify);
    }
    
      public function getBedType($accommodation_id){
        $bedTypes = BedType::where('accommodation_id', $accommodation_id)->whereNull('room_id')->get();
        return response()->json($bedTypes);
    }
    
    public function getOccupiedBed(){
        $pageTitle   = "Occupied Bed List";
        $todaysBookedRoomIds    = BookedRoom::active()->where('booked_for', todaysDate())->pluck('room_id')->toArray();
        $bedTypes               = BedType::with('accommodation', 'room')->whereIn('room_id', $todaysBookedRoomIds)->paginate(getPaginate());
         
         return view('admin.hotel.beds.occupied_vacant_beds', compact('pageTitle','bedTypes'));
    }
    
        public function getVacantBed(){
        $pageTitle   = "Vacant Bed List";
        $todaysBookedRoomIds    = BookedRoom::active()->where('booked_for', todaysDate())->pluck('room_id')->toArray();
        $bedTypes               = BedType::with('accommodation', 'room')->whereNotIn('room_id', $todaysBookedRoomIds)->paginate(getPaginate());
         
         return view('admin.hotel.beds.occupied_vacant_beds', compact('pageTitle','bedTypes'));
    }

}
