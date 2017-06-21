<?php

use Illuminate\Database\Seeder;

class SensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 3)->create();

        $type = new \App\SensorType();
        $type->description = 'parking';
        $type->save();

        factory(\App\Sensor::class, 5)->create()->each(function ($sensor) use ($type){
            $sensor->type_id = $type->id;
            $sensor->save();
        });

        \App\Sensor::all()->each(function ($s){

        factory(\App\Coordinate::class, 5)->create()->each(function ($coordinate) use ($s) {
                $pf = new \App\ParkingFigure();
                $pf->sensor_id = $s->id;
                $pf->coordinate_id = $coordinate->id;
                $pf->save();
            });
        });
    }
}
