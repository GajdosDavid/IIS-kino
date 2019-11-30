<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class piece extends Model
{
    public $timestamps = false;

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }
}
