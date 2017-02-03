<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trouble;

class TroublesAdmController extends Controller
{
    private $trouble;
    private $user_id;
    
    public function __construct(Trouble $trouble) {
        $this->trouble = $trouble;
    }
    
    public function index(){
        $troubles = $this->trouble->paginate(20);
        $status = config('constants.trouble.status');
        return view('troubles.index', compact('troubles', 'status'));
    }
    
    public function destroy($id){

    }
    
    public function update(Request $request) {
       // $this->trouble->find($request->id)->update($request->all());
        $this->trouble->where('id', $request->id)
            ->update(['status' => $request->status]);
        return redirect()->route('troubles.index');
    }
    
    public function edit($id){
        $troubles = $this->trouble->find($id);
        $status = config('constants.trouble.status');
        return view('troubles.edit', compact('troubles', 'status'));
    }
    
}
