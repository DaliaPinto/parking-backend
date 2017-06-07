<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorType extends Model
{
    protected $fillable = [
        'description'
    ];

    public $timestamps = false;
}
