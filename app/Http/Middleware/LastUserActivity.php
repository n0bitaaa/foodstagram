<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use Carbon\Carbon;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$customer="customer")
    {
        if(Auth::check()){
            $expiresAt = Carbon::now()->addMinutes(12);
            Cache::put('user-is-online-' . Auth::user()->id,true,$expiresAt);
        }
        if (Auth::guard($customer)->check()) {
            $expiresAt = Carbon::now()->addMinutes(12);
            Cache::put('customer-is-online-' . Auth::guard($customer)->id(),true,$expiresAt);
        }
        return $next($request);
    }
}
