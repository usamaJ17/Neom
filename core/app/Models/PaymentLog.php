<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use Searchable;

    protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
