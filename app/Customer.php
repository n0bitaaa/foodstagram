<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    //
    protected $guarded = 'customer';

    protected $fillable = ['name','phone','email','password'];

    protected $hidden = ['created_at','updated_at'];

    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function isOnline(){
        return Cache::has('customer-is-online-' .$this->id);
    }
}
