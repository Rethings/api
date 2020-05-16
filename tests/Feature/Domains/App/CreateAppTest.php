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
use Tests\AssertRethingsResource;
use Tests\Concerns\HasJWT;
use Tests\TestCase;

class CreateAppTest extends TestCase
{
    use RefreshDatabase, HasJWT, AssertRethingsResource;

    public const ROUTE_NAME = 'apps.store';

    public function testWithValidRequest(): void
    {
        /** @var TestResponse $response */
        $response = self::postJson(route(static::ROUTE_NAME), [
            'name' => 'Test App',
            'publicKey' => self::getAppPublicKey(),
        ], self::getUserAuthHeaders('user-01'));
        $response->assertCreated();

        self::assertAppResource($response);
    }
}
