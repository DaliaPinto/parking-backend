<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorActivity extends Model
{
    protected $fillable = [
        'sensor_id', 'state'
    ];
}
