<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingFigure extends Model
{
    protected $fillable = [
        'sensor_id', 'coordinate_id'
    ];

    public $timestamps = false;
}
