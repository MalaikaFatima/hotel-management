<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'start_date',
        'end_date'
    ];
    public function room()  {
        return $this->hasOne('App\Models\Room','id','room_id');
        return $this->belongsTo(Room::class, 'room_id', 'id');

    }
    public function amenities()
{
    return $this->belongsToMany(Amenity::class, 'amenity_booking');
}

    
}
