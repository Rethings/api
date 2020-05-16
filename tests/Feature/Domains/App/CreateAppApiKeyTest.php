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
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Domains\Auth\ActorType;
use Tests\AssertRethingsResource;
use Tests\Concerns\HasJWT;
use Tests\Concerns\WithDataset;
use Tests\TestCase;

class CreateAppApiKeyTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT;

    public const ROUTE_NAME = 'apps.api-keys.store';

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
        ];
    }

    public function testWithValidRequest(): void
    {
        $response = self::postJson(
            route(self::ROUTE_NAME, ['app_01']),
            [
                'name' => 'New Reset Key',
                'type' => AppApiKeyType::RESET,
            ],
            self::getUserAuthHeaders('user-01')
        );
        $response->assertCreated();
        self::assertAppApiKeyResource($response, 'app_01', 'New Reset Key');
    }
}
