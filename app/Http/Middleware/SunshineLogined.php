<?php

namespace App\Http\Middleware;

use Closure;
use SAuth;

class SunshineLogined
{
    
    /**
     * Handle an incoming request.
     * 判断用户是否登陆 未登陆则跳转到登陆路由
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userInfo = SAuth::user();

        /*登陆后跳转地址记录*/
        SAuth::setRedirect($request);

        if ($userInfo !== FALSE) 
        {
            return isset($userInfo)
            ? $next($request)
            : redirect(SAuth::getLoginPath());
        }

        return redirect(SAuth::getLoginPath()); 
    }
}
