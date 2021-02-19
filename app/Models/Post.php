<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded=[];

    public function images(){
        return $this->hasMany('App\Models\image');
    }

    public  function users(){
        return $this->belongsTo('App\user');
    }
}
