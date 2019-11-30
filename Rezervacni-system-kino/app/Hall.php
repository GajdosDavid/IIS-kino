<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{

    public $timestamps = false;

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function performances()
    {
        return $this->belongsToMany(Performance::class, 'performance_hall');
    }
}
