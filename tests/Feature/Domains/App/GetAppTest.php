<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Tests\Feature\Domains\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Rethings\Domains\App\App;
use Tests\AssertRethingsResource;
use Tests\Concerns\HasJWT;
use Tests\Concerns\WithDataset;
use Tests\RethingsDataSamples;
use Tests\TestCase;

class GetAppTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT, RethingsDataSamples;

    public const ROUTE_NAME = 'apps.show';

    public function createDataset(): array
    {
        return [
            App::class => [
                self::createAppSample(),
            ],
        ];
    }

    public function testWithValidRequest(): void
    {
        $response = self::getJson(
            route(self::ROUTE_NAME, ['app_01']),
            self::getUserAuthHeaders('user-01')
        );
        $response->assertOk();
        self::assertAppResource($response);
    }

    public function testNoAccess(): void
    {
        $response = self::getJson(
            route(self::ROUTE_NAME, ['app_01']),
            self::getUserAuthHeaders('user-02')
        );
        $response->assertNotFound();
    }
}
