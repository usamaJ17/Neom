<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class RoomType extends Model {
    use GlobalStatus;
    protected $casts = [
        'keywords' => 'array',
        'beds'     => 'array'
    ];

    public function amenities() {
        return $this->belongsToMany(Amenity::class, 'room_type_amenities', 'room_type_id', 'amenities_id')->withTimestamps();
    }

    public function complements() {
        return $this->belongsToMany(Complement::class, 'room_type_complements', 'room_type_id', 'complement_id')->withTimestamps();
    }

    public function rooms() {
        return $this->hasMany(BedType::class);
    }

    public function activeRooms() {
        return $this->hasMany(BedType::class)->active();
    }

    public function images() {
        return $this->hasMany(RoomTypeImage::class);
    }

    public function bookedRooms() {
        return $this->hasMany(BookedRoom::class)->active();
    }

     public function accommodation(){
            return $this->belongsTo(Accommodation::class);
    }
    //scope
    public function scopeFeatured($query) {
        return $query->where('feature_status', Status::ROOM_TYPE_FEATURED);
    }

    public function featureBadge(): Attribute {
        return new Attribute(
            function () {
                $html = '';

                if ($this->feature_status == Status::ROOM_TYPE_FEATURED) {
                    $html = '<span class="badge badge--primary">' . trans('Featured') . '</span>';
                } else {
                    $html = '<span><span class="badge badge--dark">' . trans('Unfeatured') . '</span></span>';
                }

                return $html;
            }
        );
    }
}
