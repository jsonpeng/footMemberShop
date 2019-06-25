<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WeixinMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
        if (Auth::check()) {
            $user = Auth::user();
            dd($user);
            if ($user->mobile == '') {
                return url('/register');
            }else{
                return $next($request);
            }
        }else{
            return url('/weixin');
        }
        */
        if (!Auth::check()) {
            return redirect('/weixin?target='.$request->url());
        }

        return $next($request);
    }
}
