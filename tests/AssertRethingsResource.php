<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Tests;

use Illuminate\Testing\TestResponse;
use Rethings\Domains\App\App;
use Rethings\Domains\App\Enums\AppStatus;
use Tests\Concerns\AssertResponse;

trait AssertRethingsResource
{
    use AssertResponse;

    public static function assertAppResource(
        TestResponse $response,
        string $name = 'Test App',
        string $status = AppStatus::ACTIVE
    ): void {
        self::assertJsonResponse(
            $response,
            [
                'id' => static::cbStartsWith(App::getKeyPrefix()),
                'name' => $name,
                'status' => $status,
                '_links' => self::cbContains([
                    [
                        'rel' => 'self',
                        'href' => route('apps.show', [$response->json('id')], false),
                    ],
                    [
                        'rel' => 'api-keys',
                        'href' => route('apps.api-keys.index', [$response->json('id')], false),
                    ],
                ], true),
            ],
            [
                'publicKey',
            ]
        );
        self::assertJsonResponseTimestamps($response);
    }
}
