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

final class DeviceRepository
{
    public function existsByExternalId(string $externalId, string $appId): bool
    {
        return Device::whereExternalId($externalId)->whereAppId($appId)->exists();
    }
}
