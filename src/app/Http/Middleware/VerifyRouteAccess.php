<?php

namespace LaravelEnso\PermissionManager\app\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class VerifyRouteAccess
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->cannot(
            'access-route',
            $request->route()->getName()
        )) {
            throw new AuthorizationException(
                __('You are not authorized to perform this action')
            );
        }

        return $next($request);
    }
}
