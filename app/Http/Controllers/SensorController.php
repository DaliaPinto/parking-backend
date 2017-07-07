<?php

namespace App\Http\Controllers;

use App\Coordinate;
use App\ParkingFigure;
use App\Sensor;
use App\SensorActivity;
use App\SensorType;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller
{
    /**
     * GeoJson Api data
     */
    public function geoJsonData()
    {
        $sensors = Sensor::where('type_id', 1)->with('figures.coordinate')->get();

        $features = collect();
        $coordinates = collect();

        foreach ($sensors as $s) {
            foreach ($s->figures as $f) {
                $coordinates->push([$f->coordinate->latitude, $f->coordinate->length]);
            }
            $features->push([
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [$coordinates]
                ],
                'properties' => [
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

    /**
     * get all the cars in parking per day
     */
    public function getActivityByDay(Request $request){

        $date = $request['date'];
        $hours = $this->getHours();

        //to do -> contar despues de agrupar por hora
        $activities = SensorActivity::select('created_at')->where([
            ['created_at', '>=', $date.' 00:00:00'],
            ['created_at', '<=', $date.' 23:59:59']
        ])->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('h:i');
        });



        return response()->json([
            'analytics' => [
                'month' => $date,
                'prueba'=> $activities
            ]
        ]);

    }

    /**
     * array of hours
     */
    public function getHours() {
        $amount = array();

        for($i=0; $i<24; $i++) {
            $hour = new \stdClass();

            if(strlen($i) < 2) $hour->hour = '0'.$i.':00';
            else $hour->hour = $i.':00';

            $hour->amount = NULL;
            array_push($amount, $hour);
        }
        return $amount;
    }
}