<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class BookingActionHistory extends Model {
    use Searchable;

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}
