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

use Closure;
use Rethings\Domains\Auth\Actor;
use Rethings\Domains\Auth\ActorType;
use Rethings\Exceptions\AuthenticationException;
use Rethings\Exceptions\AuthorizationException;

class ValidateActorType
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next, string $type)
    {
        /** @var Actor $user */
        $user = $request->user();
        if (!$user) {
            throw new AuthenticationException();
        }

        $type = new ActorType($type);
        if (!$type->equals($user->getActorType())) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
