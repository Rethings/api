<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Tests\Concerns;

use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

/**
 * Trait AssertResponse.
 *
 * @method TestResponse
 */
trait AssertResponse
{
    public static function cbStartsWith(string $prefix): callable
    {
        return function ($value) use ($prefix): void {
            static::assertIsString($value);
            static::assertStringStartsWith($prefix, $value);
        };
    }

    public static function cbContains($expected, bool $multiple = false): callable
    {
        return function ($value) use ($expected, $multiple): void {
            if ($multiple) {
                foreach ($expected as $subExpected) {
                    static::assertContains($subExpected, $value);
                }
            } else {
                static::assertContains($expected, $value);
            }
        };
    }

    public static function splitCallbacks(array $data): array
    {
        $expected = Arr::dot($data);
        $callables = array_filter($expected, function ($item) {
            return is_callable($item) && !is_string($item);
        });

        return [
            Arr::undot(
                Arr::except($expected, array_keys($callables))
            ),
            $callables,
        ];
    }

    public static function assertJsonResponse(TestResponse $response, array $expected, array $missing = []): void
    {
        [$expected, $callables] = AssertResponse::splitCallbacks($expected);
        $response->assertJson($expected);
        foreach ($callables as $key => $callable) {
            $callable(Arr::get($response, $key));
        }
        $response->assertJsonMissing($missing);
    }

    public static function assertJsonResponseTimestamps(TestResponse $response, array $fields = ['createdAt', 'updatedAt']): void
    {
        foreach ($fields as $field) {
            static::assertNotNull(Arr::get($response, $field), 'Missing timestamp: ' . $field);

            try {
                new \DateTimeImmutable(Arr::get($response, $field));
            } catch (\Exception $exception) {
                static::assertFalse(true, 'Invalid timestamp');
            }
        }
    }

    public static function assertJsonCollectionResponse(TestResponse $response, callable $callback): void
    {
        if ($response->offsetExists(0)) {
            $items = $response->json();
            foreach ($items as $item) {
                $callback(
                    new TestResponse(
                        new Response(
                            json_encode($item),
                            $response->getStatusCode(),
                            $response->headers->all()
                        )
                    )
                );
            }
        }
    }
}
