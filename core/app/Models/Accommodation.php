<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;

class Accommodation extends Model
{
    use HasFactory;
    use GlobalStatus;
    protected $guarded = [];


     public function amenities()
        {
            return $this->hasMany(Amenity::class);
        }
        
         public function newBedTypes()
        {
            return $this->hasMany(NewBedType::class);
        }
        
         public function bedTypes()
    {
        return $this->hasMany(BedType::class);
    }
    
     public function roomTypes()
    {
        return $this->hasMany(RoomType::class);
    }
    
     public function guests()
    {
        return $this->hasMany(User::class);
    }
    
     public function admin()
    {
        return $this->belongsTo(Admin::class, 'accommodation_id', 'id');
    }
}
