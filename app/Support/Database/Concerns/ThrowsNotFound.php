<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Database\Concerns;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;

trait ThrowsNotFound
{
    /**
     * @param int|int[]|string|string[] $id
     */
    public static function buildNotFoundException($id)
    {
        $ids = Arr::wrap($id);

        return (new ModelNotFoundException())
            ->setModel(static::class, $ids);
    }

    /**
     * @param int|int[]|string|string[] $id
     */
    public static function throwNotFound($id): void
    {
        throw static::buildNotFoundException($id);
    }
}
