<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Device\Events;

use DateTimeImmutable;
use Illuminate\Queue\SerializesModels;
use Rethings\Support\Events\WithTimestamp;

final class DeviceWasRegistered
{
    use SerializesModels, WithTimestamp;

    private int $deviceId;

    public function __construct(int $deviceId)
    {
        $this->deviceId = $deviceId;
        $this->timestamp = new DateTimeImmutable();
    }

    public function getDeviceId(): int
    {
        return $this->deviceId;
    }
}
