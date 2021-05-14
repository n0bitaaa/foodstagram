<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Food extends Model
{
    //
    protected $guarded = ['created_at','updated_at'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function orders(){
        return $this->belongsToMany(Order::class,'order_foods');
    }
}
