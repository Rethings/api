<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Device\Actions;

use Rethings\Domains\Auth\Actor;
use Rethings\Domains\Device\Device;
use Rethings\Domains\Device\Events\DeviceWasRegistered;

final class RegisterDevice
{
    public function execute(
        Actor $owner,
        string $appId,
        string $externalId,
        ?string $name,
        array $metadata = [],
        array $tags = []
    ): Device {
        $device = Device::forceCreate(
            compact('externalId', 'appId', 'name', 'metadata', 'tags', 'owner')
        );

        event(new DeviceWasRegistered($device->getKey()));

        return $device;
    }
}
