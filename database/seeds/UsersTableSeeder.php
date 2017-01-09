<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        User::truncate();
        //DB::statement("TRUNCATE TABLE users CASCADE");
        User::create(['name'=>'Cristiano','email'=>'cristiano@cristianolamas.com.br','password'=>bcrypt('123456'),'is_admin'=>1]);
        User::create(['name'=>'Fábio','email'=>'fabio.fapeli@gmail.com','password'=>bcrypt('123456'),'is_admin'=>0]);
       
    }
}
