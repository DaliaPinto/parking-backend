<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'state', 'block_id','type_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\SensorType');
    }

    public function block()
    {
        return $this->belongsTo('App\Block');
    }

    public function figures()
    {
        return $this->hasMany('App\ParkingFigure');
    }

    public $timestamps = false;
}
