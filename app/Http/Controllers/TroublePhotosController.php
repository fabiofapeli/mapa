<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TroublePhoto;
use App\Trouble;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TroublePhotosController extends Controller
{
    private $troublephoto;
    private $trouble;
    
    public function __construct(TroublePhoto $troublephoto, Trouble $trouble) {
        $this->troublephoto = $troublephoto;
        $this->trouble = $trouble;
    }
    
    public function index($id){
        $photos = $this->troublephoto->where('trouble_id', $id)->orderby('id','desc')->get(['id', 'extension']);
        return $photos;
    }
    
    public function total($id){
        $photos = $this->troublephoto->where('trouble_id', $id)->get();
        return $response = ['total' => $photos->count()];
    }
    
    public function destroy($id){
        $photo = $this->troublephoto->find($id);
        $trouble_id = $photo->trouble_id;
        $user_id = $this->trouble->find($trouble_id)->user_id;
        if(\Auth::user()->id == $user_id){
            $image_path=$photo->id.'.'.$photo->extension;
            if(file_exists(public_path('images\\troubles\\').$image_path)) Storage::disk('public_local')->delete($image_path);
            $photo->delete();
            return $response = ['status' => 'success'];
        }
    }
    
    public function upload(Request $request){        
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $image = $this->troublephoto->create(['trouble_id' => $request->trouble_id, 'extension' => $extension]);
        $image_path = "images\\troubles\\" . $image->id.'.'.$extension;
        Storage::disk('public_local')->put($image_path,File::get($file)); 
        echo Storage::disk('public_local')->url($image_path);
    }

}
