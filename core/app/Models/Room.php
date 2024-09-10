<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Room extends Model {
    use GlobalStatus, Searchable;

    protected $guarded = [];
    
     public function room()
    {
        return $this->belongsTo(BedType::class);
    }
    
    public function bedType()
    {
        return $this->belongsTo(NewBedType::class,'bed_type_id');
    }

    public function roomStatus() {
        return $this->hasOne(Status::class,'room_id');
    }

    public function booked() {
        return $this->hasMany(BookedRoom::class, 'room_id');
    }
    public function roomKey()
    {
        return $this->hasOne(RoomKey::class,'bed_type_id');
    }
    
     public function accommodation(){
            return $this->belongsTo(Accommodation::class);
    }

}
