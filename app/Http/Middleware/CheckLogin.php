<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$arg = '')
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        return $next($request);
    }
}
