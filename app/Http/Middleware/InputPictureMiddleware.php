<?php

namespace App\Http\Middleware;

use Closure;

class InputPictureMiddleware
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
        if (!Request::hasFile('userPic')) {
            throw new \App\Models\MobileApiException("User picture required", 
                    \App\Models\MobileApiException::ERROR_INCORRECT_DATA);
        }
        
        return $next($request);
    }
}