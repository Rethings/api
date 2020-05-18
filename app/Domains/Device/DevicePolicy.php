<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Device;

use Rethings\Domains\Auth\Actor;
use Rethings\Domains\Auth\ActorType;

final class DevicePolicy
{
    public function register(Actor $actor)
    {
        return $actor->getActorType()->is(ActorType::CONSUMER);
    }

    public function read(Actor $actor, Device $device)
    {
        return $device->isOwnedBy($actor);
    }

    public function update(Actor $actor, Device $device)
    {
        return $device->isOwnedBy($actor);
    }
}
