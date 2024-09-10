<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Booking;
use App\Models\Accommodation;
use App\Models\BookedRoom;
use App\Models\RoomType;
use App\Models\Room;

class BookingImport implements ToModel, WithHeadingRow
{
   
    public function model(array $row)
    {
// dd($row);
        $accommodation = Accommodation::where('name', $row['accommodation'])->first();
        $room_type = RoomType::where('name', $row['room_type'])->where('accommodation_id', $accommodation->id)->first();
        if($room_type){
            $room = Room::where('room_number', $row['room'])->where('accommodation_id', $accommodation->id)->where('room_type_id', $room_type->id)->first();
            if($room){
                   $guest = [];
        
          $guest['name'] = $row['name'];
            $guest['email'] = $row['email'];
            $guest['mobile'] = $row['mobile'];
            $guest['address'] = $row['address'];
            $guest['nationality'] = $row['nationality'];
            $guest['passport'] = $row['passport'];
            $guest['gender'] = $row['gender'];
            $guest['department'] = $row['department'];
            $guest['designation'] = $row['designation'];
            $guest['category'] = $row['category'];
            $guest['company'] = $row['company'];
            $guest['remarks'] = $row['remarks'];
            $guest['project'] = $row['project'];
             
             
        

        $booking = new Booking();

        $booking->booking_number = $row['booking_number'];

        $booking->accommodation_id = $accommodation->id;
        
        $booking->user_id = $row['user_id'] ?? 0;


        $booking->check_in = $row['check_in'];


        $booking->check_out = $row['check_out'];


        $booking->guest_details = $guest;


        $booking->status = $row['status'];

        $booking->save();

        $booked_room = new BookedRoom();

        $booked_room->booking_id = $booking->id;

        $booked_room->accommodation_id = $accommodation->id;

        $booked_room->room_type_id = $room_type->id;


        $booked_room->room_id = $room->id;


        $booked_room->booked_for = $row['check_in'];


        $booked_room->status = $row['status'];

        $booked_room->save();
            }
            
            else{
                return;
            }
    
        }
        else{
            return;
        }
        
     
    }
}
