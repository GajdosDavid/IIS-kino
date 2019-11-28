<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{

    public $timestamps = false;

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function halls()
    {
        return $this->belongsToMany(Role::class, 'performance_hall');
    }
}
