<?php

namespace App\Http\Middleware;

use Closure, Gate, SAuth;

class SunshineAdmin
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
            if (Gate::allows('enter-backend')) {
                return isset($userInfo)
                ? $next($request)
                : redirect(SAuth::getLoginPath());
            }
        }

        return redirect(SAuth::getLoginPath()); 
    }
}
