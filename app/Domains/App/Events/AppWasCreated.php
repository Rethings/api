<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\App\Events;

use DateTimeImmutable;
use Illuminate\Queue\SerializesModels;
use Rethings\Support\Events\WithTimestamp;

final class AppWasCreated
{
    use SerializesModels, WithTimestamp;

    private string $appId;

    public function __construct(string $appId)
    {
        $this->appId = $appId;
        $this->timestamp = new DateTimeImmutable();
    }

    public function getAppId(): string
    {
        return $this->appId;
    }
}
