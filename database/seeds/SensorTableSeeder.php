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
        $type = new \App\SensorType();
        $type->description = 'parking';
        $type->save();

        factory(\App\Coordinate::class, 25)->create()->each(function ($coordinate) use ($type) {

            for($i=0; $i<5; $i++){
                $sensor = new \App\Sensor();
                $sensor->state = 2;
                $sensor->type_id = $type->id;
                $sensor->save();
            }

            \App\Sensor::all()->each(function ($s) use ($coordinate) {
                $pf = new \App\ParkingFigure();
                $pf->sensor_id = $s->id;
                $pf->coordinate_id = $coordinate->id;
                $pf->save();
            });

        });
    }
}
