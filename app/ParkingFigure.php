<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingFigure extends Model
{
    protected $fillable = [
        'sensor_id', 'coordinate_id'
    ];

    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }

    public function coordinate()
    {
        return $this->belongsTo('App\Coordinate');
    }

    public $timestamps = false;
}
