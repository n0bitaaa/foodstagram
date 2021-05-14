<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['created_at','updated_at'];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    // public function order_foods(){
    //     return $this->hasMany('App\Order_detail');
    // }

    public function delivery(){
        return $this->belongsTo('App\Delivery');
    }

    public function foods(){
        return $this->belongsToMany(Food::class,'order_foods')->withPivot(['qty','price','rmk']);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
