<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;

class MarkersController extends Controller
{
    private $marker;
    
    public function __construct(Marker $marker) {
        $this->marker = $marker;
    }
    
    public function index(){
        $markers = $this->marker->paginate(20);
        return view('markers.index', compact('markers'));
    }
    
    public function select(){
        $markers = $this->marker->all(['id', 'name']);
        return $markers;
    }
    
    public function create() {
        return view('markers.create');
    }
    
    public function store(Request $request) {
        $this->marker->create($request->all());
        return redirect()->route('markers.index');
    }
    
    public function destroy($id){
        $this->marker->find($id)->delete();
        return redirect()->route('markers.index');
    }
    
    public function edit($id) {
        $markers = $this->marker->find($id);
        return view('markers.edit', compact('markers'));
    }
    
    public function update(Request $request) {
        $this->marker->find($request->id)->update($request->all());
        return redirect()->route('markers.index');
    }
}
