<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Auth;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests as LaravelAuthorizesRequests;

trait AuthorizesRequests
{
    use LaravelAuthorizesRequests {
        authorize as baseAuthorize;
        authorizeForUser as baseAuthorizeForUser;
        authorizeResource as baseAuthorizeResource;
    }

    /**
     * Authorize a given action for the current user.
     *
     * @param mixed $ability
     * @param array|mixed $arguments
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function authorize($ability, $arguments = [], Exception $exception = null)
    {
        try {
            return $this->baseAuthorize($ability, $arguments);
        } catch (AuthorizationException $e) {
            throw $exception ?? $e;
        }
    }

    /**
     * Authorize a given action for a user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|mixed $user
     * @param mixed $ability
     * @param array|mixed $arguments
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function authorizeForUser($user, $ability, $arguments = [], Exception $exception = null)
    {
        try {
            return $this->baseAuthorizeForUser($user, $ability, $arguments);
        } catch (AuthorizationException $e) {
            throw $exception ?? $e;
        }
    }
}
