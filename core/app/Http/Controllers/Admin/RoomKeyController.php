<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\RoomKey;
use App\Models\Accommodation;
use App\Models\Room;
use App\Models\BedType;
use Illuminate\Http\Request;

class RoomKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $pageTitle = 'All BedKey';
        
        $roomkeys = RoomKey::with('room','room.accommodation','bed')->orderBy('id')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->whereHas('room',function($query){
                $query->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
            });
        })->get();
        $rooms = Room::all();
        $beds = BedType::all();
        $accommodations = Accommodation::whereStatus(1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        
        return view('admin.hotel.roomKey.index',compact('pageTitle','roomkeys', 'rooms','beds','accommodations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomKey $roomKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomKey $roomKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomKey $roomKey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
       public function delete($id) {
        RoomKey::findOrFail($id)->delete();
        $notify[] = ['success', 'Bed key  deleted successfully'];
        return back()->withNotify($notify);
    }
    
     public function save(Request $request, $id = 0) {
        
        $rules = [
            'room_key' => 'required',
            'room'     => 'required',
        ];
    
        
        if (!$id) {
            $rules['room_key'] .= '|unique:room_keys';
        }
    
        $request->validate($rules);

        if ($request->room) {
            $room = RoomKey::where('bed_type_id', $request->bed_type_id)->exists();

            if ($room) {
                $notification = 'Bed key already exists for this room.';
                $notify[] = ['error', $notification];
                return back()->withNotify($notify);
            }
        }
        
        if ($id) {
            $roomKey = RoomKey::find($id);

            if (!$roomKey) {
                $notification = 'Bed key not found.';
                $notify[] = ['error', $notification];
                return back()->withNotify($notify);
            }

             $notification = 'Bed key updated successfully';
        } else {
            // Create a new record
            $roomKey = new RoomKey();
            $notification = 'Bed key added successfully';
        }

        $roomKey->room_key = $request->room_key;
        $roomKey->spare_key = $request->spare_key;
        $roomKey->room_id = $request->room;
        $roomKey->bed_type_id = $request->bed_type_id;
        $roomKey->save();


        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
}
