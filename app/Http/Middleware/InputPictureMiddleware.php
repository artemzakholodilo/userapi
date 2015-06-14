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
        if (!$_FILES['picture']) {
            throw new \App\Models\MobileApiException("Invalid input type", 
                    \App\Models\MobileApiException::ERROR_INCORRECT_DATA);
        }
        
        return $next($request);
    }
}
