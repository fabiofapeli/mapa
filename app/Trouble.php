<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Trouble extends Model
{
    protected $fillable = [
      'user_id', 'address', 'number', 'district', 'latitude', 'longitude', 'description', 'marker_id' 
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function marker(){
        return $this->belongsTo('App\Marker');
    }
    
    /**
     * Get coordinates by Google Maps API
     * @param string $address
     * @return arrays|null $coordinates with indexes *latitude* and *longitude* or null if address not found 
     */
    public function getCoordinates($address) {
        $coordinates = NULL;
        
        $address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
 
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
        
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);

        $json = json_decode($response,TRUE); //generate array object from the response from the web
   
        if($json['status'] != 'ZERO_RESULTS'){
            $coordinates = ['latitude' => $json['results'][0]['geometry']['location']['lat'], 'longitude'=> $json['results'][0]['geometry']['location']['lng']];
        }
        return $coordinates;
    }
    
}
