<?php

use Illuminate\Database\Seeder;
use App\Marker;

class MarkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        Marker::truncate();
        //DB::statement("TRUNCATE TABLE markers CASCADE");
        Marker::create(['name'=>'Buraco','image'=> 'N']);
        Marker::create(['name'=>'Vazamento','image'=> 'N']);
        Marker::create(['name'=>'Iluminação','image'=> 'N']);
    }
}
