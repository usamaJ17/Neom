<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{

 public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
    
    public function roomItems() {
        return $this->belongsToMany(RoomItem::class, 'room_room_item', 'room_id', 'room_item_id')->withTimestamps();
    }
    
    public function roomType() {
        return $this->belongsTo(RoomType::class);
    }
    public function beds() {
        return $this->hasMany(Room::class,'room_id');
    }
    
}
