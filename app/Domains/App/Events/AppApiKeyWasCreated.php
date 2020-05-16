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

final class AppApiKeyWasCreated
{
    use SerializesModels, WithTimestamp;

    private string $appApiKeyId;

    public function __construct(string $apiKeyId)
    {
        $this->appApiKeyId = $apiKeyId;
        $this->timestamp = new DateTimeImmutable();
    }

    public function getAppApiKeyId(): string
    {
        return $this->appApiKeyId;
    }
}
