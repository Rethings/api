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

final class DestroyDevice
{
    public function execute(Device $device, bool $force): void
    {
        $device->delete();
    }
}
