<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Apiauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->apikey=='2cff30e1-f0c2-44e1-96e1-82a45b075461'){
            return $next($request);
            }
            return response()->json(['error'=>'Api Key invalid']);
         }
}
