<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $table = 'images';

    public function comments(){
        return $this->hasMany('App\comment')->orderBy('id','desc');
    }

    public function like(){
        
        return $this->hasMany('App\like');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
