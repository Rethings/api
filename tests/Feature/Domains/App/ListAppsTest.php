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
use Illuminate\Testing\TestResponse;
use Rethings\Domains\App\App;
use Tests\AssertRethingsResource;
use Tests\Concerns\HasJWT;
use Tests\Concerns\WithDataset;
use Tests\RethingsDataSamples;
use Tests\TestCase;

class ListAppsTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT, RethingsDataSamples;

    public const ROUTE_NAME = 'apps.index';

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
            route(self::ROUTE_NAME),
            self::getUserAuthHeaders('user-01')
        );
        $response->assertOk();
        $response->assertJsonCount(1);
        self::assertJsonCollectionResponse($response, function (TestResponse $subItem): void {
            self::assertAppResource($subItem);
        });
    }

    public function testNotOwned(): void
    {
        $response = self::getJson(
            route(self::ROUTE_NAME),
            self::getUserAuthHeaders('user-02')
        );
        $response->assertOk();
        $response->assertJsonCount(0);
    }
}
