<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
   protected $fillable = [
       'name', 'image'
   ];
   
    public function Trouble(){
        return $this->hasMany('App\Trouble');
    }
}
