<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMarker extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
      'marker_id' , 'user_id'
    ];
}
