<?php

namespace App\Traits;

use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

trait BookingActions {
    private function getRooms(Request $request) {
        $checkIn = Carbon::parse($request->checkin_date);
        $checkOut = $request->checkout_date ? Carbon::parse($request->checkout_date) : $checkIn;
        $rooms = Room::active()
            ->whereHas('room', function($q) use ($request){
                return $q->where('room_type_id', $request->room_type);
            })
            ->whereBedTypeId($request->bed_type_id)
            ->with([
                'booked' => function ($q) {
                    $q->active();
                },
                'room.roomType' => function ($q) {
                    $q->select('id', 'name', 'fare');
                }
            ])
            ->get();

        if (count($rooms) < $request->rooms) {
            return ['error' => ['The requested number of rooms is not available for the selected date']];
        }

        $numberOfRooms = $request->rooms;
        $requestUnitFare = $request->unit_fare;

        return view('partials.rooms', compact('checkIn', 'checkOut', 'rooms', 'numberOfRooms', 'requestUnitFare'))->render();
    }
}
