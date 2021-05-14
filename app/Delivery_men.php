<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_men extends Model
{
    //
    protected $guarded = ['created_at','updated_at'];

    public function deliveries(){
        return $this->hasMany('App\Delivery');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
