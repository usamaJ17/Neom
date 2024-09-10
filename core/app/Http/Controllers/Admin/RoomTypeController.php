<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Amenity;
use App\Models\BedType;
use App\Models\NewBedType;
use App\Models\Complement;
use App\Models\RoomTypeImage;
use App\Models\Room;
use App\Models\Accommodation;
use Illuminate\Validation\Rule;

class RoomTypeController extends Controller {
    public function index() {
        $pageTitle   = 'All Room Types';
        $amenities   = Amenity::active()->get();
        $accommodations = Accommodation::where('status', 1)->get();
        $complements = Complement::all();
        $typeList    = RoomType::with('amenities', 'complements','accommodation')->withCount('rooms')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->latest()->get();
        return view('admin.hotel.room_type.list', compact('pageTitle', 'typeList', 'amenities', 'complements','accommodations'));
    }
    

    public function create() {
        $pageTitle   = 'Add Room Type';
        $amenities   = Amenity::active()->get();
         $accommodations = Accommodation::where('status', 1)->get();
        $complements = Complement::all();
        $bedTypes    = BedType::all();
        return view('admin.hotel.room_type.create', compact('pageTitle', 'amenities', 'complements', 'bedTypes','accommodations'));
    }

    public function edit($id) {
        $roomType    = RoomType::with('amenities', 'complements', 'rooms', 'images')->findOrFail($id);
        $pageTitle   = 'Update Room Type -' . $roomType->name;
        $amenities   = Amenity::active()->get();
        $complements = Complement::all();
        $bedTypes    = BedType::all();
        $accommodations = Accommodation::where('status', 1)->get();
        $images      = [];

        foreach ($roomType->images as $key => $image) {
            $img['id']  = $image->id;
            $img['src'] = getImage(getFilePath('roomTypeImage') . '/' . $image->image);
            $images[]   = $img;
        }

        return view('admin.hotel.room_type.create', compact('pageTitle', 'roomType', 'amenities', 'complements', 'bedTypes', 'images','accommodations'));
    }

    public function save(Request $request, $id = 0) {
        $this->validation($request, $id);

        if ($id) {
            $roomType         = RoomType::findOrFail($id);
            $notification     = 'Room type updated successfully';
        } else {
            $roomType         = new RoomType();
            $notification     = 'Room type added successfully';
        }

        $roomType->name                = $request->name;
        $roomType->total_adult         = $request->total_adult;
        $roomType->keywords            = $request->keywords ?? [];
        $roomType->description         = $request->description;
        $roomType->feature_status      = $request->feature_status ? 1 : 0;
        $roomType->cancellation_fee    = $request->cancellation_fee ?? 0;
        $roomType->cancellation_policy = $request->cancellation_policy;
        $roomType->accommodation_id    = $request->accommodation;
        $roomType->save();

        $roomType->amenities()->sync($request->amenities);
        $roomType->complements()->sync($request->complements);
        $this->insertImages($request, $roomType);

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }


    protected function validation($request, $id) {
      

            $request->validate([
            'name' => ['required','string','max:255',
                Rule::unique('room_types', 'name')->where(function ($query) use ($request) {
                return $query->where('name', $request->name)
                             ->where('accommodation_id', $request->accommodation);
                })->ignore($id),
            ],
            'total_adult'         => 'required|integer|gte:0',
            'amenities'           => 'nullable|array',
            'amenities.*'         => 'integer|exists:amenities,id',
            'keywords'            => 'nullable|array',
            'keywords.*'          => 'string',
            'complements'         => 'nullable|array',
            'complements.*'       => 'integer|exists:complements,id',
            'cancellation_policy' => 'nullable|string',
            ]);
    }

    protected function insertRooms($request, $roomTypeId, $accommodationId) {
        if ($request->room) {
            foreach ($request->room as $roomNumber) {
                $room               = new Room();
                $room->room_type_id = $roomTypeId;
                $room->accommodation_id = $accommodationId;
                $room->room_number  = $roomNumber;
                $room->save();
            }
        }
    }

    protected function insertImages($request, $roomType) {
        $path = getFilePath('roomTypeImage');
        $this->removeImages($request, $roomType, $path);

        if ($request->hasFile('images')) {
            $size = getFileSize('roomTypeImage');
            $images = [];

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            foreach ($request->file('images') as $file) {
                try {
                    $name = fileUploader($file, $path, $size);
                    $roomTypeImage        = new RoomTypeImage();
                    $roomTypeImage->image = $name;
                    $images[] = $roomTypeImage;
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload the logo'];
                    return back()->withNotify($notify);
                }
            }

            $roomType->images()->saveMany($images);
        }
    }

    protected function removeImages($request, $roomType, $path) {
        $previousImages = $roomType->images->pluck('id')->toArray();
        $imageToRemove  = array_values(array_diff($previousImages, $request->old ?? []));

        foreach ($imageToRemove as $item) {
            $roomImage   = RoomTypeImage::find($item);
            @unlink($path . '/' . $roomImage->image);
            $roomImage->delete();
        }
    }

    public function status($id) {
        return RoomType::changeStatus($id);
    }
    
    public function getroomType($accommodation_id){
         $data['roomtypes'] = RoomType::where('accommodation_id', $accommodation_id)->get();
         $data['bedtypes'] = NewBedType::where('accommodation_id', $accommodation_id)->get();
        
        return response()->json($data);
    }
}
