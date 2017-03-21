<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trouble;
use App\UserMarker;
use App\App;

class TroublesController extends Controller
{
    private $trouble;
    private $user_id;
    private $user_marker;
    private $app;
    
    public function __construct(Trouble $trouble, UserMarker $user_marker, App $app) {
        $this->trouble = $trouble;
        $this->user_marker = $user_marker;
        $this->app = $app;
    }
    
    public function index() {
        $user_id = \Auth::user()->id;
        $troubles = $this->trouble->where('user_id', $user_id)->get();
        $data = array();
        $status = config('constants.trouble.status');
        foreach ($troubles as $trouble){
            array_push($data, [
                'id'      => $trouble->id,
                'address' => $trouble->address,
                'marker'  => $trouble->marker->name,
                'status'  => $status[$trouble->status]
            ]);
        }
        
        $response = ['total' => $troubles->count(), 'data' => $data];
        return \Response::json($response); 
    }
    
    public function index_admin(){
        $troubles = $this->trouble->paginate(20);
        $status = config('constants.trouble.status');
        return view('troubles.index', compact('troubles', 'status'));
    }
    
    public function map($status, $uuid) {  
       $app = $this->app->where('uuid', $uuid)->get(['user_id'])->toArray();
       $user_id = $app[0]['user_id'];

       $markers = $this->user_marker->where('user_id', $user_id)->get(['marker_id'])->toArray();
       
       //$troubles  = $this->trouble->where(['status' => $status])->whereIn(['marker_id', [1, 2]])->get();  
        $troubles = \App\Trouble::where(['status' => $status])->whereNotIn('marker_id', $markers)->get();
       return view('troubles.map', compact('troubles','status'));
       
    }
    
    public function all() {
        $troubles = $this->trouble->all();
        
        $data = array();
        foreach ($troubles as $trouble){
            array_push($data, [
                'id'       =>  $trouble->id,
                'address'  =>  $trouble->address,
                'number'   =>  $trouble->number,
                'district' =>  $trouble->district,
                'latitude' =>  $trouble->latitude,
                'longitude'=>  $trouble->longitude,
                'marker'   =>  $trouble->marker->name,
                'description'   =>  $trouble->description
            ]);
        }
        
        return $data; 
    }
    
    public function edit($id) {
        $trouble = $this->trouble->find($id, ['address', 'number', 'district', 'marker_id', 'description']);
        return $trouble;
    }

    public function store(Request $request) {
             
        $address = $request['number'] . " " . $request['address'] .  ", Buritis, MG";
        $coordinates = $this->trouble->getCoordinates($address);
        
        if(is_null($coordinates)){
           $status = "error"; 
           $message = "Endereço não localizado";
           $id = 0;
        }else{
               
            $user_id = \Auth::user()->id;

            $data = [
                    'user_id'       => $user_id,
                    'address'       => $request->address, 
                    'number'        => $request->number,
                    'district'      => $request->district,
                    'latitude'      => $coordinates['latitude'],
                    'longitude'     => $coordinates['longitude'],
                    'description'   => $request->description,
                    'marker_id'     => $request->marker_id 
                  ];
           
           $trouble = $this->trouble->create($data);
           $status = "success" ;
           $message = "Cadastrado com sucesso";
           $id = $trouble->id;
        }
        
        $response = ['status' => $status, 'message' => $message, 'id' => $id];
        return \Response::json($response); 
    }
    
     public function update(Request $request) {
        
        $address = $request['number'] . " " . $request['address'] .  ", Buritis, MG";
        $coordinates = $this->trouble->getCoordinates($address);
        
        if(is_null($coordinates)){
           $status = "error"; 
           $message = "Endereço não localizado";
        }else{
           
            $data = [
                    'address'       => $request->address, 
                    'number'        => $request->number,
                    'district'      => $request->district,
                    'latitude'      => $coordinates['latitude'],
                    'longitude'     => $coordinates['longitude'],
                    'description'   => $request->description,
                    'marker_id'     => $request->marker_id 
                  ];
           
           $this->trouble->find($request->id)->update($data);
           $status = "success" ;
           $message = "Editado com sucesso";
        
        }
        
        $response = ['status' => $status, 'message' => $message];
        return \Response::json($response);
       

    }
}
