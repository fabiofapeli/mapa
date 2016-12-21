<?php
namespace App;
use Orchestra\Testbench\TestCase;
use App\User;

abstract class AbstractTestCase extends TestCase
{

    public function migrate(){
        $this->artisan('migrate',[
            '--realpath' => realpath(__DIR__."/../database/migrations")
        ]);
        User::create(['name'=>'Cristiano','email'=>'cristiano@cristianolamas.com.br','password'=>bcrypt('123456'),'is_admin'=>1]);
        User::create(['name'=>'Fábio','email'=>'fabio.fapeli@gmail.com','password'=>bcrypt('123456'),'is_admin'=>0]);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /*
    public function getPackageProviders($app)
    {
        return [
            \Cviebrock\EloquentSluggable\SluggableServiceProvider::class
        ];
    }
    */
}
