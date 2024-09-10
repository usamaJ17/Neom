<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomKey extends Model
{
    use HasFactory;
    protected $guarded = [];
    
     public function bed()
    {
        return $this->belongsTo(Room::class,'bed_type_id');
    }
     public function room()
    {
        return $this->belongsTo(BedType::class,'room_id');
    }
}
