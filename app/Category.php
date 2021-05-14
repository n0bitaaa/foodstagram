<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [
        'created_at','updated_at'
    ];

    public function foods(){
        return $this->hasMany('App\Food');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
