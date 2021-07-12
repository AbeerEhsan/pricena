<?php

namespace App\Http\Middleware;

use App\Models\Store;
use Closure;

class ExternalApiMiddleware
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
        if(request()->has('access_token')) {
            $store = Store::where('access_token', request()->get('access_token'))->first();
            if(isset($store))
            {
                return $next($request);

            }
        }
        return response()->json(['status'=>false,'message'=>'not authorized']);

    }
}
