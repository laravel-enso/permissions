<?php

namespace LaravelEnso\PermissionManager\app\Http\Middleware;

use Closure;

class VerifyRouteAccess
{
    public function handle($request, Closure $next)
    {
        if (!$request->user()->hasAccessTo($request->route()->getName())) {
            throw new \EnsoException(__('You are not authorized here'), 403);
        }

        return $next($request);
    }
}
