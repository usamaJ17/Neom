<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewBedType;
use App\Models\Room;
use App\Models\BookedRoom;
use App\Models\Accommodation;
use Illuminate\Validation\Rule;

class NewBedTypeController extends Controller {
    public function index() {
        $pageTitle   = "Bed Type List";
        $bedTypes = NewBedType::with('accommodation')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->latest()->get();
        $accommodations = Accommodation::where('status', 1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        return view('admin.hotel.new_bed_type', compact('pageTitle', 'bedTypes', 'accommodations'));
    }

    public function save(Request $request, $id = 0) {
        $request->validate([
            'name' => ['required','string','max:255'],
            'accommodation_id' => 'required',
            'accessories_id' => 'required',
            'adult' => 'required',
        ]);

        if ($id) {
            $bedType      = NewBedType::findOrFail($id);
            $notification = 'Bed type updated successfully';
        } else {
            $bedType      = new NewBedType();
            $notification = 'Bed type added successfully';
        }

        $bedType->name = $request->name;
        $bedType->adult = $request->adult;
        $bedType->accommodation_id = $request->accommodation_id;
        $bedType->accessories_id = json_encode($request->accessories_id);
        $bedType->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function delete($id) {
        NewBedType::findOrFail($id)->delete();
        $notify[] = ['success', 'Bed type deleted successfully'];
        return back()->withNotify($notify);
    }
    
}
