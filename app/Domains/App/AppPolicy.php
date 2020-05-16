<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\App;

use Rethings\Domains\Auth\Actor;
use Rethings\Domains\Auth\ActorType;

final class AppPolicy
{
    public function create(Actor $actor): bool
    {
        return $actor->getActorType()->is(ActorType::USER);
    }

    public function read(Actor $actor, App $app): bool
    {
        return $app->isOwnedBy($actor);
    }

    public function update(Actor $actor, App $app): bool
    {
        return $app->isOwnedBy($actor);
    }

    public function deactivate(Actor $actor, App $app): bool
    {
        return $app->isOwnedBy($actor);
    }

    public function restore(Actor $actor, App $app): bool
    {
        return $app->isOwnedBy($actor);
    }

    public function readApiKeys(Actor $actor, App $app): bool
    {
        return $app->isOwnedBy($actor);
    }

    public function invalidateApiKey(Actor $actor, App $app): bool
    {
        return $app->isOwnedBy($actor);
    }

    public function createApiKey(Actor $actor, App $app): bool
    {
        return $app->isOwnedBy($actor);
    }

    public function readApiKey(Actor $actor, App $app): bool
    {
        return $app->isOwnedBy($actor);
    }
}
