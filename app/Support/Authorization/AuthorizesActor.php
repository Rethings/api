<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Authorization;

use Rethings\Domains\Auth\Actor;

trait AuthorizesActor
{
    public function authorize(Actor $actor): AuthorizeActor
    {
        return new AuthorizeActor($actor);
    }
}
