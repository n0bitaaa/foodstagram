<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function deliveries(){
        return $this->hasMany('App\Delivery');
    }

    public function delivery_mens(){
        return $this->hasMany('App\Delivery_men');
    }
    public function isOnline(){
        return Cache::has('user-is-online-' .$this->id);
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
}
