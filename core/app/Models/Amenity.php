<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model {
    use GlobalStatus;
    
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
