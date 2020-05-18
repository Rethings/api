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

use Rethings\Domains\App\App;

final class DeviceRepository
{
    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function findByExternalId(string $externalId): Device
    {
        return Device::whereExternalId($externalId)
            ->whereAppId($this->app->getKey())->firstOrFail();
    }

    public function existsByExternalId(string $externalId): bool
    {
        return Device::whereExternalId($externalId)
            ->whereAppId($this->app->getKey())->exists();
    }
}
