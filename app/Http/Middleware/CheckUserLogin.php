<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //khai báo trong Kernel
    public function handle($request, Closure $next)
    {
        if(get_data_user('web'))
        {
        return $next($request);
    }
    return redirect()->to('/');
    }
}
