<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Http\Middleware;

use Auth;
use Closure;
use Rethings\Exceptions\AuthorizationException;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next, string $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
