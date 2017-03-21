<?php

namespace App\Http\Middleware;

use Closure;

class VerifySocialProvider
{
    /**
     * Check if requested social provider is handled in the app
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config('services.'.$request->provider) === null) {
            abort(404);
        }

        return $next($request);
    }
}
