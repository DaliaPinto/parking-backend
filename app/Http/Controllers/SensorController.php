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

        $properties = array();
        $features = array();
        //$data = array();

        foreach($sensors as $s){
            /*$data = array(
                'geometry' => [
                    'type' => 'Polygon',
                ]
            );*/
            //array_push($features, $data);
            foreach ($s->figures as $f){
                $data['coordinates'] = array($f->coordinate->latitude, $f->coordinate->length);
                array_push($features, $data);
            }
            $properties = array(
                'properties' => [
                'id' => $s->id,
                'state' => $s->status
            ]);
            //array_push($features, $properties);

        }

       return response()->json([
           'type' => "FeatureCollection",
           'features' => $features
        ]);
    }
}
