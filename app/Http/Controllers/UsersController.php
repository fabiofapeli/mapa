<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;
use App\UserMarker;

class UsersController extends Controller
{
    
    private $marker;
    private $userMarker;
    
    public function __construct(Marker $marker, UserMarker $userMarker) {
        $this->marker = $marker;
        $this->userMarker = $userMarker;
    }
    
    public function index(){
        $user_id = \Auth::user()->id;
        $markers = $this->marker->all(['id', 'name']);
        
        foreach($markers as $marker){   
            $total = $this->userMarker->where(['user_id' => $user_id])->where(['marker_id' => $marker->id])->get()->count();
            $userMarker[] = ['id' => $marker->id,'total' => $total, 'name' => $marker->name];
       }
    return $userMarker;
    }
    
    public function filter(Request $request) {
        $user_id = \Auth::user()->id;
        $this->userMarker->where(['user_id' => $user_id])->delete();
        
       $markers = $this->marker->all(['id']);
       foreach($markers as $marker){
            if(!(in_array($marker->id, $request->markers))){
                $this->userMarker->create(['user_id' => $user_id, 'marker_id' => $marker->id]);
            }
       }
       $response = ['status' => 'success'];
       return \Response::json($response);
    }
}
