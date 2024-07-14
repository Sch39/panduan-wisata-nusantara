<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Middleware\ThrottleRequests as Middleware;

class IgnoreThrottleRequests extends Middleware
{
    protected function resolveRequestSignature($request)
    {
        // Skip throttling for exempt routes
        if ($this->isExemptRoute($request)) {
            return null;
        }

        return parent::resolveRequestSignature($request);
    }

    protected function isExemptRoute($request)
    {
        $route = $request->route();
        // Check if the route has the 'throttle_exempt' attribute
        return $route && $route->getAction('throttle_exempt');
    }

    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1, $prefix = '')
    {
        // Skip throttling for exempt routes
        if ($this->isExemptRoute($request)) {
            return $next($request);
        }

        return parent::handle($request, $next, $maxAttempts, $decayMinutes, $prefix);
    }
}
