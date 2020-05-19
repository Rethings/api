<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Mqtt\Listeners;

use Log;
use Rethings\Domains\Mqtt\Actions\SyncCredential;
use Rethings\Domains\Mqtt\Events\MqttCredentialWasCreated;
use Rethings\Domains\Mqtt\MqttCredential;

final class MqttCredentialWasCreatedListener
{
    private SyncCredential $syncCredential;

    public function __construct(SyncCredential $syncCredential)
    {
        $this->syncCredential = $syncCredential;
    }

    public function handle(MqttCredentialWasCreated $event): void
    {
        $credential = MqttCredential::find($event->getCredentialId());
        if (!$credential) {
            Log::warning('Missing MQTT Credential: ' . $event->getCredentialId());

            return;
        }
        $this->syncCredential->execute($credential);
    }
}
