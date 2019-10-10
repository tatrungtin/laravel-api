<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogMiddleware 
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
        Log::info('API|REQUEST|' . $request->ip() . '|' . $request->path() . '|', array_except($request->all(), ['password']));
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $content = json_decode($response->getContent(), true);
        if ($content) {
            Log::info('API|RESPONSE|' . $request->ip() . '|' . $request->path() . '|', $content);
        } else {
            Log::info('API|RESPONSE|' . $request->ip() . '|' . $request->path());
        }
    }

}
