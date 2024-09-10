<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;


class StaffTransfer extends Model
{
     use HasFactory;
    use GlobalStatus;
    
    
    protected $table = 'transfer_staff';
    protected $guarded = [];
    
     public function user()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }
    
         public function admin()
    {
        return $this->belongsTo(Admin::class, 'transfer_by', 'id');
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id', 'id');
    }
    public function preaccommodation()
    {
        return $this->belongsTo(Accommodation::class, 'previous_accommodation', 'id');
    }
    public function prevBooking()
    {
        return $this->belongsTo(Booking::class,'booking_id');
    }

}
