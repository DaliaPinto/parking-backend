<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected $fillable = [
        'latitude', 'length'
    ];

    public $timestamps = false;
}
