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
use Rethings\Domains\App\AppApiKey;
use Tests\AssertRethingsResource;
use Tests\Concerns\HasJWT;
use Tests\Concerns\WithDataset;
use Tests\RethingsDataSamples;
use Tests\TestCase;

class DestroyAppApiKeyTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT, RethingsDataSamples;

    public const ROUTE_NAME = 'apps.api-keys.destroy';

    public function createDataset(): array
    {
        return [
            App::class => [
                self::createAppSample(),
            ],
            AppApiKey::class => [
                self::createAppApiKeySample(),
            ],
        ];
    }

    public function testInvalidateRequest(): void
    {
        $response = self::deleteJson(
            route(self::ROUTE_NAME, ['app_01', 'rk_01']),
            [],
            self::getUserAuthHeaders('user-01')
        );
        $response->assertNoContent();
        self::assertSoftDeleted('app_api_keys', [
            'id' => 'rk_01',
            'app_id' => 'app_01',
        ]);
    }

    public function testForceDeleteRequest(): void
    {
        $response = self::deleteJson(
            route(self::ROUTE_NAME, ['app_01', 'rk_01']),
            [
                'force' => true,
            ],
            self::getUserAuthHeaders('user-01')
        );
        $response->assertNoContent();
        self::assertDatabaseMissing('app_api_keys', [
            'id' => 'rk_01',
            'app_id' => 'app_01',
        ]);
    }

    public function testNoAccess(): void
    {
        $response = self::deleteJson(
            route(self::ROUTE_NAME, ['app_01', 'rk_01']),
            [],
            self::getUserAuthHeaders('user-02')
        );
        $response->assertNotFound();
    }
}
