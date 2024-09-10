<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomItem;
use App\Models\Room;
use App\Models\RoomItemInspection;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\AdminNotification;

class RoomItemController extends Controller {
    public function index() {
        $pageTitle = 'All Room Items';
        $roomitems = RoomItem::with('accommodation')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->orderBy('created_at', 'desc')->get();
        $accommodations = Accommodation::where('status',1)->get();
        return view('admin.hotel.room_items.room_items', compact('pageTitle', 'roomitems','accommodations'));
    }

    public function save(Request $request, $id = 0) {
        $request->validate([
          
            'name' => ['required','string','max:255',
                    Rule::unique('room_items', 'name')->where(function ($query) use ($request) {
                    return $query->where('name', $request->name)
                                 ->where('accommodation_id', $request->accommodation_id);
                    })->ignore($id),
            ],
            'tags' => 'required',
            'accommodation_id' => 'required'
        ]);

        if ($id) {
            $roomitems          = RoomItem::findOrFail($id);
            $notification       = 'RoomItem updated successfully';
        } else {
            $roomitems          = new RoomItem();
            $notification       = 'RoomItem added successfully';
        }
        $roomitems->name   = $request->name;
        $roomitems->quantity    = $request->quantity;
        $roomitems->tags    = json_encode($request->tags);
        $roomitems->unique_code    = Str::slug($request->name)."-". uniqid();
        $roomitems->accommodation_id = $request->accommodation_id;
        $roomitems->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return RoomItem::changeStatus($id);
    }
    public function getRoomitems($accommodation_id)
{
    $roomitems = RoomItem::where('accommodation_id', $accommodation_id)->get();
    
    return response()->json($roomitems);
}

        public function inspection() {
            $pageTitle = 'Room Items Inspection';
            $roomitem_inspections = RoomItemInspection::with('accommodation','admin','room','room.roomType','bed')->orderBy('room_id')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
            $accommodations = Accommodation::where('status',1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
            $rooms = Room::get();
            return view('admin.hotel.room_items.roon_item_inspection', compact('pageTitle', 'roomitem_inspections','accommodations','rooms'));
        }

     public function store(Request $request, $id = 0) {
         
        $request->validate([
            'accommodation_id' => 'required',
            'room_id' => 'required',
            'bed_id' => 'required',
            'status' => 'required|in:checkout,checkin',
        ]);
        
        $roomitems          = new RoomItemInspection();
        $roomitems->user_id   = auth()->guard('admin')->user()->id;
        $roomitems->room_id    = $request->room_id;
        $roomitems->bed_id    = $request->bed_id;
        if($request->room_item_id)
        {
            $roomitems->room_item_id    = json_encode($request->room_item_id);
        }
        
        if($request->damage_room_item_id)
        {
            $roomitems->damage_room_item_id    = json_encode($request->damage_room_item_id);
        }
        $roomitems->status    = $request->status;
        $roomitems->remarks    = $request->remarks;
        $roomitems->accommodation_id = $request->accommodation_id;
        $roomitems->save();
        
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->guard('admin')->user() ? auth()->guard('admin')->user()->id : 0;
        $adminNotification->title = 'Room Item Inspection';
        $adminNotification->click_url = urlPath('admin.hotel.room-item.inspection', $roomitems->id);
        $adminNotification->save();
        
        
        $notification       = 'RoomItem Inspection added successfully';
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
}