<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Tests;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;
use Rethings\Domains\App\App;
use Rethings\Domains\App\Enums\AppApiKeyStatus;
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Domains\App\Enums\AppStatus;
use Rethings\Domains\Device\Device;
use Rethings\Domains\Mqtt\Enum\AuthenticationMethod;
use Tests\Concerns\AssertResponse;

trait AssertRethingsResource
{
    use AssertResponse;

    public static function assertAppApiKeyResource(
        TestResponse $response,
        string $appId = 'app_01',
        string $name = 'Test Reset Key',
        string $type = AppApiKeyType::RESET,
        string $status = AppApiKeyStatus::ACTIVE
    ): void {
        self::assertJsonResponse(
            $response,
            [
                'key' => static::cbStartsWith($type === AppApiKeyType::RESET ? 'rk_' : 'sk_'),
                'type' => $type,
                'name' => $name,
                'status' => $status,
                '_links' => self::cbContains([
                    [
                        'rel' => 'app',
                        'href' => route('apps.show', [$appId], false),
                    ],
                ], true),
            ]
        );
        self::assertJsonResponseTimestamps(
            $response,
            $status === AppStatus::ACTIVE ?
                ['createdAt'] :
                ['invalidatedAt', 'createdAt']
        );
    }

    public static function assertAppResource(
        TestResponse $response,
        string $name = 'Test App',
        string $status = AppStatus::ACTIVE
    ): void {
        self::assertJsonResponse(
            $response,
            [
                'id' => static::cbStartsWith(App::getKeyPrefix()),
                'name' => $name,
                'status' => $status,
                '_links' => self::cbContains([
                    [
                        'rel' => 'self',
                        'href' => route('apps.show', [$response->json('id')], false),
                    ],
                    [
                        'rel' => 'api-keys',
                        'href' => route('apps.api-keys.index', [$response->json('id')], false),
                    ],
                ], true),
            ],
            [
                'publicKey',
            ]
        );
        self::assertJsonResponseTimestamps(
            $response,
            $status === AppStatus::ACTIVE ?
                ['createdAt', 'updatedAt'] :
                ['deactivatedAt', 'createdAt', 'updatedAt']
        );
    }

    public static function assertDeviceResource(
        TestResponse $response,
        string $externalId = null,
        string $name = 'Test Device',
        array $metadata = ['foo' => 'bar'],
        array $tags = ['sample']
    ): void {
        self::assertJsonResponse(
            $response,
            [
                'id' => $externalId ?? static::cbStartsWith(Device::getKeyPrefix()),
                'name' => $name,
                'metadata' => $metadata,
                'tags' => $tags,
                '_links' => self::cbContains([
                    [
                        'rel' => 'self',
                        'href' => route('devices.show', [$response->json('id')], false),
                    ],
                ], true),
            ],
            [
                'namespace',
            ]
        );
        self::assertJsonResponseTimestamps($response, ['createdAt', 'updatedAt']);
    }

    public static function assertMqttCredentialResource(
        TestResponse $response,
        string $idPrefix = null,
        string $username = null,
        string $authenticationMethod = AuthenticationMethod::USERNAME,
        array $publishableTopics = [],
        array $subscribableTopics = []
    ): void {
        self::assertJsonResponse(
            $response,
            [
                'id' => static::cbStartsWith($idPrefix),
                'username' => $username ?? static::cbStartsWith($idPrefix),
                'authenticationMethod' => $authenticationMethod,
                'publishableTopics' => $publishableTopics,
                'subscribableTopics' => $subscribableTopics,
            ],
            [
                $authenticationMethod === AuthenticationMethod::USERNAME ?
                    'pem' : 'username',
            ]
        );
        self::assertJsonResponseTimestamps($response, ['createdAt']);

        $id = $response['id'];
        $randomChars = Arr::last(explode('_', $id));
        self::assertSame(6, mb_strlen($randomChars), 'Invalid random characters length.');
    }
}
