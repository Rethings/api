<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Exceptions;

use Illuminate\Auth\AuthenticationException as LaravelAuthenticationException;

class AuthenticationException extends LaravelAuthenticationException
{
}
