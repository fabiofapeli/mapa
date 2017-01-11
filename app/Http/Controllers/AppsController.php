<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\App;
use App\User;


class AppsController extends Controller
{
   
    private $app;
    
    public function __construct(App $app) {
        $this->app = $app;
    }
    
    public function login(Request $request) {
        
        $credentials = array(
		'email' => $request->email, 
		'password' => $request->password,
	);
        
        $response = $this->app->authentication($credentials);
        
        $this->app->addApp(
            [
                'uuid' => $request->uuid,
                'regid' => $request->regid,
                'platform' => $request->platform,
                'model' => $request->model,
                'user_id' => $response['id']
            ]
         );
        
	return \Response::json($response);
        
    }
    
    public function connected($uuid){
        $app = $this->app->keepConnect($uuid);
        $response = ['app' => $app];
        return \Response::json($response);
    }
    
    public function logout($uuid){
        $response = ['status' => $this->app->logout($uuid)];
        return \Response::json($response);
    }
    
    public function register(Request $request){
        $message = 'OK';
        
        if(User::where('email',$request['email'])->first()){
            $message = "Email já existe";
        }
        else if($request['password'] != $request['password-confirm']){
            $message = "Senhas não conferem";
        }
        else{
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            
            
            $this->app->addApp(
                [
                    'uuid' => $request['uuid'],
                    'regid' => $request['regid'],
                    'platform' => $request['platform'],
                    'model' => $request['model'],
                    'user_id' => $user->id
                ]
             );
            
            \Auth::loginUsingId($user->id);
        }
        
        $response = ['status' => $message];
        return \Response::json($response); 
    }

}
