<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('production')) {
            $request->server->set('HTTPS', 'on');
            $request->server->set('SERVER_PORT', 443);
        }
        return $next($request);
    }
}
