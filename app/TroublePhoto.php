<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TroublePhoto extends Model
{
    protected $fillable = [
      'trouble_id' ,
        'extension'
    ];
    
    public function marker(){
        return $this->belongsTo('App\Marker');
    }
    
    public function Trouble(){
        return $this->belongsTo('App\Trouble');
    }
}
