<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BedAccessory;
use App\Models\Room;
use App\Models\BookedRoom;
use App\Models\Accommodation;
use Illuminate\Validation\Rule;

class BedAccessoriesController  extends Controller {
    public function index() {
        $pageTitle   = "Bed Accessories";
        
        $bedAccessory = BedAccessory::with('accommodation')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->latest()->get();
        $accommodations = Accommodation::where('status', 1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        return view('admin.hotel.bed_accessories.all', compact('pageTitle', 'bedAccessory', 'accommodations'));
        
    }

    public function save(Request $request, $id = 0) {
        $request->validate([
           
            'name' => ['required','string','max:255',
                    Rule::unique('bed_accessories', 'name')->where(function ($query) use ($request) {
                    return $query->where('name', $request->name)
                                 ->where('accommodation_id', $request->accommodation_id);
                    })->ignore($id),
            ],
            'accommodation_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($id) {
            $bedAccessory      = BedAccessory::findOrFail($id);
            $notification = 'Bed Accessory updated successfully';
        } else {
            $bedAccessory      = new BedAccessory();
            $notification = 'Bed Accessory added successfully';
        }

        $bedAccessory->name = $request->name;
        $bedAccessory->accommodation_id = $request->accommodation_id;
        $bedAccessory->quantity = $request->quantity;
        $bedAccessory->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function delete($id) {
        BedAccessory::findOrFail($id)->delete();
        $notify[] = ['success', 'Bed Accessory deleted successfully'];
        return back()->withNotify($notify);
    }
    
      public function getBedType($accommodation_id){
        $bedTypes = BedAccessory::where('accommodation_id', $accommodation_id)->whereNull('room_id')->get();
        // dd($bedTypes);
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
