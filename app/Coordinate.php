<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected $fillable = [
        'latitude', 'length'
    ];

    public function figures()
    {
        return $this->hasMany('App\ParkingFigure');
    }

    public function sensors()
    {
        return $this->hasMany('App\Sensor');
    }

    public $timestamps = false;
}
