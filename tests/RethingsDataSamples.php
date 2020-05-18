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

use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Domains\Auth\ActorType;

trait RethingsDataSamples
{
    public static function createAppSample(array $attributes = []): array
    {
        return $attributes + [
                'id' => 'app_01',
                'name' => 'Test App',
                'publicKey' => self::getAppPublicKey(),
                'ownerId' => 'user-01',
                'ownerType' => ActorType::USER,
            ];
    }

    public static function createAppApiKeySample(array $attributes = []): array
    {
        return $attributes + [
                'id' => 'rk_01',
                'type' => new AppApiKeyType(AppApiKeyType::RESET),
                'name' => 'Test Reset Key',
                'appId' => 'app_01',
            ];
    }

    public static function createDeviceSample(array $attributes = []): array
    {
        return $attributes + [
                'externalId' => 'dev_01',
                'name' => 'Test Device',
                'metadata' => ['foo' => 'bar'],
                'tags' => ['sample'],
                'appId' => 'app_01',
                'ownerId' => 'consumer-01',
                'ownerType' => ActorType::CONSUMER,
            ];
    }
}
