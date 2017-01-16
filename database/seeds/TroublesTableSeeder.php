<?php

use Illuminate\Database\Seeder;
use App\Trouble;

class TroublesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement("SET foreign_key_checks = 0");
        //Trouble::truncate();
        DB::statement("TRUNCATE TABLE troubles CASCADE");
        Trouble::create(['id'=>1, 'user_id'=> 1, 'address'=>'R. Castelo Branco',             'number'=> '253', 'district'=> 'Veredas', 'latitude'=> -15.624134, 'longitude'=> -46.426954, 'description'=> 'Lorem ipsum Cillum ea dolor.', 'marker_id'=> 1]);
        Trouble::create(['id'=>2, 'user_id'=> 2, 'address'=>'Av. Pedro Valadares Versiane',  'number'=> '782', 'district'=> 'Veredas', 'latitude'=> -15.627950, 'longitude'=> -46.422845, 'description'=> 'Lorem ipsum Cillum ea dolor.', 'marker_id'=> 1]);
        Trouble::create(['id'=>3, 'user_id'=> 1, 'address'=>'R. Jucelino Kubitscheck',       'number'=> '340', 'district'=> 'Centro',  'latitude'=> -15.629926, 'longitude'=> -46.419786, 'description'=> 'Lorem ipsum Cillum ea dolor.', 'marker_id'=> 2]);
        Trouble::create(['id'=>4, 'user_id'=> 2, 'address'=>'R. Brasília',                   'number'=> '743', 'district'=> 'Vereda',  'latitude'=> -15.620839, 'longitude'=> -46.421704, 'description'=> 'Lorem ipsum Cillum ea dolor.', 'marker_id'=> 3]);
    }
}
