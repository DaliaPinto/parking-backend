<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'status', 'coordinate_id', 'type_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\SensorType');
    }

    public function coordinate()
    {
        return $this->belongsTo('App\Coordinate');
    }

    public function figures()
    {
        return $this->hasMany('App\ParkingFigure');
    }

    public $timestamps = false;
}
