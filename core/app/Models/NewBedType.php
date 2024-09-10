<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewBedType extends Model
{

 public function accessory()
    {
        return $this->belongsTo(BedAccessory::class,'accessories_id');
    } 
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
    public function beds()
    {
        return $this->hasMany(Room::class,'bed_type_id');
    }
}
