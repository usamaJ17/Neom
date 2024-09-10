<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use GlobalStatus;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
      public function accommodation()
    {
        return $this->hasOne(Accommodation::class, 'id', 'accommodation_id');
    }
}
