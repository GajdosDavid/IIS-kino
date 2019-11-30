<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $casts = [
        'seats' => 'array'
    ];

    protected $fillable = ['seats','isPaid', 'firstName', 'surname', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function performance()
    {
        return $this->belongsTo(Performance::class);
    }
}
