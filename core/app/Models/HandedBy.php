<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HandedBy extends Model
{
protected $table = 'handed_by';
protected $guarded = [];

 public function user()
    {
        return $this->belongsTo(User::class,'guest');
    }
}
