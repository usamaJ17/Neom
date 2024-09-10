<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\BookedRoom;
use App\Models\RoomType;
use App\Models\RoomItem;
use App\Models\Accommodation;
use App\Models\BedType;
use Illuminate\Validation\Rule;

class RoomController extends Controller {
    
    public function index() {
        $pageTitle = 'All Beds';
        $roomTypes = RoomType::get();
        $roomItems = RoomItem::get();
        $accommodations = Accommodation::where('status', 1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        $beds = BedType::get();
    
        $rooms = Room::searchable(['room_number', 'bedType:name'])->filter(['bed_type_id'])->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->orderBy('room_number');
    
        // if (request()->has('bedType') && request()->has('accommodation')) {
        //     $rooms->with('bedType', 'roomItems','accommodation')->where('room_type_id', request()->roomType)
        //           ->where('accommodation_id', request()->accommodation);
        // }
    
        if (request()->status == Status::ENABLE || request()->status == Status::DISABLE) {
            $rooms->filter(['status']);
        }
    
        $rooms =  $rooms->with('room','roomStatus','bedType','accommodation')->orderBy('room_number', 'asc')->get();
    
        return view('admin.hotel.room_list', compact('pageTitle', 'rooms', 'roomTypes', 'roomItems', 'beds', 'accommodations'));
    }


    public function status($id) {
        return Room::changeStatus($id);
    }
    
    public function save(Request $request, $id = 0) {
       
       
        $request->validate([
            'room_number' => 'required',
            'room_id' => 'required',
            'bed_type_id' => 'required',
            'accommodation_id' => 'required',
        ]);
        
         if ($id) {
            $room      = Room::findOrFail($id);
            $notification = 'Bed updated successfully';
        } else {
            $room      = new Room();
            $notification = 'Bed added successfully';
        }

        $room->room_number          = $request->room_number;
        $room->bed_type_id         = $request->bed_type_id;
        $room->room_id         = $request->room_id;
        $room->accommodation_id     = $request->accommodation_id;
         $room->save();
         
        // $room->roomitems()->sync($request->roomitems);
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
    
    public function getroom($accommodation_id){
        $data['roomtypes'] = RoomType::where('accommodation_id', $accommodation_id)->get();
        $data['rooms'] = BedType::where('accommodation_id', $accommodation_id)->get();
        $data['items'] = RoomItem::where('accommodation_id', $accommodation_id)->get();
        return response()->json($data);
    }
    
    public function getOccupiedRoom(){
        $pageTitle = 'Occupied Beds';
        // $bookedRooms = BookedRoom::active()->where('booked_for', todaysDate())->pluck('room_id')->toArray();
        $bookedRooms    = BookedRoom::active()->pluck('room_id')->toArray();
        $rooms = Room::with('bedType','accommodation')->whereIn('id', $bookedRooms)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
     
        return view('admin.hotel.rooms.occupied_vacant_rooms', compact('pageTitle','rooms'));
    }
    
        public function getVacantRoom(){
        $pageTitle = 'Vacant Beds';
       
        // $bookedRooms = BookedRoom::active()->where('booked_for', todaysDate())->pluck('room_id')->toArray();
        $bookedRooms    = BookedRoom::active()->pluck('room_id')->toArray();
        $rooms = Room::with('bedType','accommodation','room')->whereNotIn('id', $bookedRooms)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
      
       
        return view('admin.hotel.rooms.occupied_vacant_rooms', compact('pageTitle','rooms'));
    }
        public function delete($id) {
        Room::findOrFail($id)->delete();
        $notify[] = ['success', 'Bed deleted successfully'];
        return back()->withNotify($notify);
    }
}
