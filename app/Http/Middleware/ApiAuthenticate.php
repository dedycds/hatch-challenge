<?php

namespace App\Http\Middleware;

use Closure;
use Config;

class ApiAuthenticate
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
    	if($request->has('key')) {
            $key = $request->get('key');
        	if($key !== Config::get('api.key'))
        		return response('Unauthorized.', 401);
        } else {
        	return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
