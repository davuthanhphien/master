<?php

namespace App\Http\Middleware;


use Closure;
use App\Http\Controllers\Auth;
use Route;

class CheckPermission
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
        $a = request()->route()->getAction();
        $b = $a['controller'];

        if(auth()->user()->hasPermisstion($b)){
            return $next($request);
        }else
            return redirect()
                ->back()
                ->with('message','bạn không có quyền truy cập');
    }
}
