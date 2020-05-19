<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Mqtt\Events;

use DateTimeImmutable;
use Illuminate\Queue\SerializesModels;
use Rethings\Support\Events\WithTimestamp;

final class MqttCredentialWasCreated
{
    use SerializesModels, WithTimestamp;

    private string $credentialId;

    public function __construct(string $credentialId)
    {
        $this->credentialId = $credentialId;
        $this->timestamp = new DateTimeImmutable();
    }

    public function getCredentialId(): string
    {
        return $this->credentialId;
    }
}
