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

use Rethings\Domains\Device\Device;

final class UpdateDevice
{
    public function execute(
        Device $device,
        ?string $name,
        array $metadata = [],
        array $tags = []
    ): Device {
        $device->forceFill(compact('name', 'metadata', 'tags'))->save();

        return $device;
    }
}
