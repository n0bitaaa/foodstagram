<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    //
    protected $guarded = ['created_at','updated_at'];

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function delivery_men(){
        return $this->belongsTo('App\Delivery_men');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
