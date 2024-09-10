<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomItemInspection extends Model
{
    
    protected $guarded = [];

 public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
    
     public function room()
    {
        return $this->belongsTo(BedType::class,'room_id');
    }
    
    public function bed()
    {
        return $this->belongsTo(Room::class,'bed_id');
    }
    
      public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
