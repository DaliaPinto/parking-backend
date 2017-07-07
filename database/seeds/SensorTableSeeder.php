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

        for($i=0; $i<5;$i++) {
            $block = new \App\Block();
            $block->description = 'Sector ' .($i+1). 'A';
            $block->save();


            factory(\App\Sensor::class, 1)->create()->each(function ($sensor) use ($type, $block) {
                $sensor->type_id = $type->id;
                $sensor->block_id = $block->id;
                $sensor->save();
            });
        }

        \App\Sensor::all()->each(function ($s){

            for($i=0; $i<3; $i++) {

                $act = new \App\SensorActivity();
                $act->sensor_id = $s->id;
                $act->state = rand(1, 2);
                $act->save();
            }

        factory(\App\Coordinate::class, 5)->create()->each(function ($coordinate) use ($s) {
                $pf = new \App\ParkingFigure();
                $pf->sensor_id = $s->id;
                $pf->coordinate_id = $coordinate->id;
                $pf->save();
            });
        });
    }
}
