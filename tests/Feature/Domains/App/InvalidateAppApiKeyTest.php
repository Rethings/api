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
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Domains\Auth\ActorType;
use Tests\AssertRethingsResource;
use Tests\Concerns\HasJWT;
use Tests\Concerns\WithDataset;
use Tests\TestCase;

class InvalidateAppApiKeyTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT;

    public const ROUTE_NAME = 'apps.api-keys.destroy';

    public function createDataset(): array
    {
        return [
            App::class => [
                [
                    'id' => 'app_01',
                    'name' => 'Test App',
                    'publicKey' => self::getAppPublicKey(),
                    'ownerId' => 'user-01',
                    'ownerType' => ActorType::USER,
                ],
            ],
            AppApiKey::class => [
                [
                    'id' => 'rk_01',
                    'type' => new AppApiKeyType(AppApiKeyType::RESET),
                    'name' => 'Test Reset Key',
                    'appId' => 'app_01',
                ],
            ],
        ];
    }

    public function testWithValidRequest(): void
    {
        $response = self::deleteJson(
            route(self::ROUTE_NAME, ['app_01', 'rk_01']),
            [],
            self::getUserAuthHeaders('user-01')
        );
        $response->assertNoContent();

        $response->assertNoContent();
        self::assertTrue(AppApiKey::whereNotNull('invalidated_at')
            ->whereAppId('app_01')
            ->whereId('rk_01')
            ->exists());
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
