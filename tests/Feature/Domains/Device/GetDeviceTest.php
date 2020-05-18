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
use Rethings\Domains\App\App;
use Rethings\Domains\Device\Device;
use Tests\AssertRethingsResource;
use Tests\Concerns\HasJWT;
use Tests\Concerns\WithDataset;
use Tests\RethingsDataSamples;
use Tests\TestCase;

class GetDeviceTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT, RethingsDataSamples;

    public const ROUTE_NAME = 'devices.show';

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

    public function testWithValidRequest(): void
    {
        $response = self::getJson(
            route(self::ROUTE_NAME, ['dev_01']),
            self::getConsumerAuthHeaders('consumer-01', 'app_01')
        );
        $response->assertOk();
        self::assertDeviceResource($response);
    }

    public function testNoAccess(): void
    {
        $response = self::getJson(
            route(self::ROUTE_NAME, ['dev_01']),
            self::getConsumerAuthHeaders('consumer-02', 'app_01')
        );
        $response->assertNotFound();
    }
}
