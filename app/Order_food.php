<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_food extends Model
{
    protected $table = 'order_foods';

    protected $guarded = ['created_at','updated_at'];

   
}
