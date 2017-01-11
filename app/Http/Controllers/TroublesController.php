<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trouble;

class TroublesController extends Controller
{
    private $trouble;
    private $user_id;
    
    public function __construct(Trouble $trouble) {
        $this->trouble = $trouble;
    }
    
    public function index() {
        $user_id = \Auth::user()->id;
        $troubles = $this->trouble->where('user_id', $user_id)->get();
        $data = array();
        foreach ($troubles as $trouble){
            array_push($data, [
                'id'      => $trouble->id,
                'address' => $trouble->address,
                'marker'  => $trouble->marker->name
            ]);
        }
        
        $response = ['total' => $troubles->count(), 'data' => $data];
        return \Response::json($response); 
    }
    
    public function map() {
        $troubles = $this->trouble->all();
        return view('troubles.map', compact('troubles'));
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
