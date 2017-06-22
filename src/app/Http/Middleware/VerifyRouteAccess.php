<?php

namespace LaravelEnso\PermissionManager\app\Http\Middleware;

use Closure;

class VerifyRouteAccess
{
    public function handle($request, Closure $next)
    {
        if (!$request->user()->hasAccessTo($request->route()->getName())) {
            \Log::warning('The user having id [ '.$request->user()->id.' ] is not allowed on route [ '.$request->route()->getName().' ] ');

            throw new \EnsoException(__('You are not authorized here'), 'error', [], 403);
        }

        return $next($request);
    }
}
