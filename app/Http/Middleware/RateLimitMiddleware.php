<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;

class RateLimitMiddleware
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = 'global'; 
        $limit = 1000; 
        $decayMinutes = 1; 
    
        $maxAttempts = $this->limiter->attempts($key);
    
        if ($maxAttempts >= $limit) {
            return response()->json(['error' => 'Too many requests. Please try again later.'], 429);
        }
    
        $this->limiter->hit($key, $decayMinutes * 60);
    
        return $next($request);
    }
    
}
