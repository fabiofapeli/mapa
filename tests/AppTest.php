<?php
namespace App;

use App\App;


class AppTest extends AbstractTestCase
{
    
    public function setUp(){
        parent::setUp();
        $this->migrate();
        $this->createApp();
    }
    
    public function test_check_if_a_app_can_be_persisted() {
        App::create(['uuid' => '2', 'user_id' => 1]);
        $app = App::all()->last();
        $this->assertEquals('2',$app->uuid);
    }
    
    public function test_check_if_return_error_when_incorrect_credential() {
        
        $credentials =  array(
		'email' => 'teste', 
		'password' => 'teste',
	);
        
        $app = new App();
        
        $response = $app->authentication($credentials);
        
        $this->assertFalse($response['status']);
        $this->assertEquals('Dados incorretos. Tente novamente', $response['message']);

    }
    
    public function test_check_if_uuid_associate_with_app(){
        $uuid = 1;
        $app = new App();
        $response = $app->keepConnect($uuid);
        
        $this->assertInstanceOf(App::class, $response);
    }
    
    public function test_check_if_uuid_does_not_exists() {
        $uuid = 4;
        $app = new App();
        $response = $app->keepConnect($uuid);
        
        $this->assertFalse($response);
    }
    
    public function test_check_if_uuid_exists_and_login_it_happened_with_success(){
        $uuid = 1;
        $app = new App();
        $response = $app->keepConnect($uuid);
        
        $this->assertEquals($response->user_id, \Auth::user()->id);
    }
    
    public function test_check_if_logout_it_happened_with_success(){
        $uuid = 1;
        $app = new App();
        $app->keepConnect($uuid);
        
        $app->logout($uuid);
        $this->assertFalse(\Auth::check());        
        
    }
    
    public function test_check_if_app_delete_on_database(){
        $uuid = 1;
        $app = new App();
        $app->keepConnect($uuid);
        $response = $app->keepConnect($uuid);
        
        $app->logout($uuid);
        $this->assertNull(App::where('uuid',$uuid)->first());
    }
    
    public function createApp() {
        App::create(['uuid' => '1', 'user_id' => 1]);
    }

}
