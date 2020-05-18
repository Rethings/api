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

class UpdateAppTest extends TestCase
{
    use RefreshDatabase, WithDataset, AssertRethingsResource, HasJWT, RethingsDataSamples;

    public const ROUTE_NAME = 'apps.update';

    public function createDataset(): array
    {
        return [
            App::class => [
                self::createAppSample(),
            ],
        ];
    }

    public function testWithValidPutRequest(): void
    {
        /** @var TestResponse $response */
        $response = self::putJson(route(static::ROUTE_NAME, ['app_01']), [
            'name' => 'Updated App',
            'publicKey' => self::getAppPublicKey(),
        ], self::getUserAuthHeaders('user-01'));
        $response->assertOk();
        self::assertAppResource($response, 'Updated App');
    }

    public function testWithValidPatchRequest(): void
    {
        /** @var TestResponse $response */
        $response = self::patchJson(route(static::ROUTE_NAME, ['app_01']), [
            'name' => 'Updated App',
        ], self::getUserAuthHeaders('user-01'));
        $response->assertOk();
        self::assertAppResource($response, 'Updated App');
    }

    public function testNoAccess(): void
    {
        /** @var TestResponse $response */
        $response = self::patchJson(route(static::ROUTE_NAME, ['app_01']), [
            'name' => 'Updated App',
        ], self::getUserAuthHeaders('user-02'));
        $response->assertNotFound();
    }
}
