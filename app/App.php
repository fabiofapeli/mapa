<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    
    protected $fillable = [
      'uuid', 'regid', 'platform', 'model', 'user_id'  
    ];
    
     public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function authentication($credentials) {
        $message = '';
        $id = 0;
        
        if (\Auth::attempt( $credentials )){
            $status = true;
            $id = \Auth::user()->id;
	}else{
            $status = false;
            $message = 'Dados incorretos. Tente novamente';
        }
                
        return ['status' => $status, 'message' => $message, 'id' => $id];
        
    }
    
    public function addApp($data) {
        if($data['user_id'] > 0){
            $this->updateOrCreate(
                    $data,
                [
                    'uuid' => $data['uuid']
                ]   
            );
        }
    }
    
    public function keepConnect($uuid){
        $app = App::where('uuid', $uuid)->first();
        if ($app === null) {
            return false;
        }
        else{
            \Auth::loginUsingId($app->user_id);
            return $app;
        }
    }
    
    public function logout($uuid){

        if ($app = App::where('uuid', $uuid)->first()) {
            $app->find($app->id)->delete();
            \Auth::logout();
            return true;
        }
        else{
            return false;
        }
       
    }
    
}
