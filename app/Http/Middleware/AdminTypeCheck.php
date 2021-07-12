<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminTypeCheck
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
        $request = $next($request);
        $user = Auth::user();
        if($user){
            if($user->type!='admin'){
                Auth::logout();
                return redirect('/login');
            }
        }
        return $request;
    }
}
