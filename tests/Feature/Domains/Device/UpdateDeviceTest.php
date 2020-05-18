<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Tests\Feature\Domains\Device;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Rethings\Domains\App\App;
use Rethings\Domains\Device\Device;
use Tests\AssertRethingsResource;
use Tests\Concerns\HasJWT;
use Tests\Concerns\WithDataset;
use Tests\RethingsDataSamples;
use Tests\TestCase;

class UpdateDeviceTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT, RethingsDataSamples;

    public const ROUTE_NAME = 'devices.update';

    public function createDataset(): array
    {
        return [
            App::class => [
                self::createAppSample(),
            ],
            Device::class => [
                self::createDeviceSample(),
            ],
        ];
    }

    public function testWithValidPutRequest(): void
    {
        /** @var TestResponse $response */
        $response = self::putJson(route(static::ROUTE_NAME, ['dev_01']), [
            'name' => 'Updated Device',
        ], self::getConsumerAuthHeaders('consumer-01', 'app_01'));
        $response->assertOk();
        self::assertDeviceResource(
            $response,
            null,
            'Updated Device',
            [],
            []
        );
    }

    public function testWithValidPatchRequest(): void
    {
        /** @var TestResponse $response */
        $response = self::patchJson(route(static::ROUTE_NAME, ['dev_01']), [
            'name' => 'Updated Device',
        ], self::getConsumerAuthHeaders('consumer-01', 'app_01'));
        $response->assertOk();
        self::assertDeviceResource($response, null, 'Updated Device');
    }

    public function testNoAccess(): void
    {
        /** @var TestResponse $response */
        $response = self::patchJson(route(static::ROUTE_NAME, ['dev_01']), [
            'name' => 'Updated App',
        ], self::getConsumerAuthHeaders('consumer-02', 'app_01'));
        $response->assertNotFound();
    }
}
