<?php

namespace App\Http\Controllers;

use App\ParkingFigure;
use App\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function getSensors()
    {
        $sensor = Sensor::where('type_id', 1)->with(['figures.coordinate'])->select('id', 'status')->get();

        return response()->json([
            'sensor' => $sensor
        ]);
    }
}
