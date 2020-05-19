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

use Illuminate\Support\Str;
use Rethings\Domains\Auth\Actor;
use Rethings\Domains\Device\Device;
use Rethings\Domains\Device\Events\DeviceWasRegistered;
use Rethings\Domains\Mqtt\Actions\CreateMqttCredential;
use Rethings\Domains\Mqtt\Enum\AuthenticationMethod as MqttAuthenticationMethod;
use Rethings\Domains\Mqtt\MqttTopicHelper;

final class RegisterDevice
{
    private CreateMqttCredential $createMqttCredential;

    public function __construct(CreateMqttCredential $createMqttCredential)
    {
        $this->createMqttCredential = $createMqttCredential;
    }

    public function execute(
        Actor $owner,
        string $appId,
        string $externalId,
        ?string $name,
        array $metadata = [],
        array $tags = []
    ): Device {
        $namespace = $externalId . '_' . Str::random(6);
        $device = Device::forceCreate(
            compact('externalId', 'appId', 'name', 'metadata', 'tags', 'owner', 'namespace')
        );

        event(new DeviceWasRegistered($device->getKey()));

        $this->createMqttCredentialForDevice($device);

        return $device;
    }

    private function createMqttCredentialForDevice(Device $device): void
    {
        $credential = $this->createMqttCredential->execute(
            new MqttAuthenticationMethod(MqttAuthenticationMethod::USERNAME),
            $device->namespace,
            $device->namespace,
            $this->getDefaultPublishableTopics($device->namespace),
            $this->getDefaultSubscribableTopics($device->namespace)
        );
        $device->mqttCredentials()->save($credential);
    }

    private function getDefaultPublishableTopics(string $usernameId): array
    {
        return [
            MqttTopicHelper::resolve($usernameId, 'stream'),
            MqttTopicHelper::resolve('$reset', $usernameId),
        ];
    }

    private function getDefaultSubscribableTopics(string $usernameId): array
    {
        return [
            MqttTopicHelper::resolve($usernameId, 'control'),
        ];
    }
}
