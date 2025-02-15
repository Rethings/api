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

class DestroyAppTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT, RethingsDataSamples;

    public const ROUTE_NAME = 'apps.destroy';

    public function createDataset(): array
    {
        return [
            App::class => [
                self::createAppSample(),
            ],
        ];
    }

    public function testDeactivateRequest(): void
    {
        $response = self::deleteJson(
            route(self::ROUTE_NAME, ['app_01']),
            [],
            self::getUserAuthHeaders('user-01')
        );
        $response->assertNoContent();
        self::assertSoftDeleted('apps', [
            'id' => 'app_01',
        ]);
    }

    public function testForceDeleteRequest(): void
    {
        $response = self::deleteJson(
            route(self::ROUTE_NAME, ['app_01']),
            [
                'force' => true,
            ],
            self::getUserAuthHeaders('user-01')
        );
        $response->assertNoContent();
        self::assertDatabaseMissing('apps', [
            'id' => 'app_01',
        ]);
    }

    public function testNoAccess(): void
    {
        $response = self::deleteJson(
            route(self::ROUTE_NAME, ['app_01']),
            [],
            self::getUserAuthHeaders('user-02')
        );
        $response->assertNotFound();
    }
}
