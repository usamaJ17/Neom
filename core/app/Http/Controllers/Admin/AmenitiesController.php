<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AmenitiesController extends Controller {
    public function index() {
        $pageTitle = 'All Amenities';
        $amenities = Amenity::with('accommodation')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->orderBy('title')->get();
        $accommodations = Accommodation::where('status',1)->get();
        return view('admin.hotel.amenities', compact('pageTitle', 'amenities','accommodations'));
    }

    public function save(Request $request, $id = 0) {
        $request->validate([
            // 'title'     => 'required|string|unique:amenities,title,' . $id,
            'title' => ['required','string','max:255',
                Rule::unique('amenities', 'title')->where(function ($query) use ($request) {
                return $query->where('title', $request->title)
                             ->where('accommodation_id', $request->accommodation_id);
                })->ignore($id),
            ],
            'icon'      => 'required',
            'accommodation_id' => 'required'
        ]);

        if ($id) {
            $amenities          = Amenity::findOrFail($id);
            $notification       = 'Amenity updated successfully';
        } else {
            $amenities          = new Amenity();
            $notification       = 'Amenity added successfully';
        }
        $amenities->title   = $request->title;
        $amenities->icon    = $request->icon;
        $amenities->accommodation_id = $request->accommodation_id;
        $amenities->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return Amenity::changeStatus($id);
    }
    public function getAmenities($accommodation_id)
{
    $amenities = Amenity::where('accommodation_id', $accommodation_id)->get();
    
    return response()->json($amenities);
}
}
