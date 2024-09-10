<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

protected $guarded = [];

 public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
     public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function bed()
    {
        return $this->belongsTo(BedType::class,'bed_id');
    }

}
