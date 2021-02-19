<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded=[];

    public function posts(){
        return $this->belongsTo('App\Models\Post');
    }
}
