<?php
namespace App;

use App\Trouble;


class TroubleTest extends AbstractTestCase
{
    
    public function setUp(){
        parent::setUp();
        $this->migrate();
    }
    
    public function test_check_if_return_latitude_and_longitude() {
        $address = "253 R. Castelo Branco, Buritis, MG";
        
        $trouble = new Trouble();
        $coordinates = $trouble->getCoordinates($address);
        
        $this->assertEquals(-15.6241344, $coordinates['latitude']);
        $this->assertEquals(-46.4269536, $coordinates['longitude']);
    }
    
    public function test_check_if_return_null_when_address_does_not_exists() {
        $address = "XXX, ZZZZ, YY";
        
        $trouble = new Trouble();
        $coordinates = $trouble->getCoordinates($address);
        
        $this->assertNull($coordinates);
    }

}
