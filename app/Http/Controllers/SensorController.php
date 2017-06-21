<?php

namespace App\Http\Controllers;

use App\Coordinate;
use App\ParkingFigure;
use App\Sensor;
use App\SensorType;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function getSensors()
    {
        $sensors = Sensor::where('type_id', 1)->with('figures.coordinate')->get();

        $features = collect();
        $coordinates = collect();

        foreach($sensors as $s){
            foreach ($s->figures as $f){
                $coordinates->push([$f->coordinate->latitude, $f->coordinate->length]);
            }
            $features->push([
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [$coordinates]
                ],
                'properties' =>[
                'id' => $s->id,
                'state' => $s->state
            ]]);
            $coordinates = collect();
        }

       return response()->json([
           'type' => "FeatureCollection",
           'features' => $features
        ]);
    }
}
