<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;

class RoomItem extends Model
{
   use GlobalStatus;
    
    protected $guarded = [];
   
   protected $table = 'room_items';
   
    
     public function room()
    {
        return $this->belongsTo(Room::class);
    }

         public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}