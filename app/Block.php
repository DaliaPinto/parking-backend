<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'description'
    ];

    public function sensors()
    {
        return $this->hasMany('App\Sensor');
    }

    public $timestamps = false;
}
