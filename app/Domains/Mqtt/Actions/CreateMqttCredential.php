<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Mqtt\Actions;

use Rethings\Domains\Mqtt\Enum\AuthenticationMethod;
use Rethings\Domains\Mqtt\Events\MqttCredentialWasCreated;
use Rethings\Domains\Mqtt\MqttCredential;

final class CreateMqttCredential
{
    public function execute(
        AuthenticationMethod $authenticationMethod,
        string $id,
        string $username,
        array $publishableTopics,
        array $subscribableTopics
    ): MqttCredential {
        $credential = MqttCredential::forceCreate(compact(
            'id',
            'username',
            'publishableTopics',
            'subscribableTopics',
            'authenticationMethod'
        ));

        event(new MqttCredentialWasCreated($credential->getKey()));

        return $credential;
    }
}
