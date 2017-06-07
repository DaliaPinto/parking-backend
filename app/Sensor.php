<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'status', 'coordinate_id', 'type_id'
    ];

    public $timestamps = false;
}
