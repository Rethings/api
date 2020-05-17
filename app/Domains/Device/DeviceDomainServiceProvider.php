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

use Rethings\Providers\DomainServiceProvider;

final class DeviceDomainServiceProvider extends DomainServiceProvider
{
    public function listeners(): array
    {
        return [
        ];
    }

    public function aliases(): array
    {
        return [
        ];
    }

    public function policies(): array
    {
        return [
            Device::class => DevicePolicy::class,
        ];
    }

    public function morphMap(): array
    {
        return [
        ];
    }
}
