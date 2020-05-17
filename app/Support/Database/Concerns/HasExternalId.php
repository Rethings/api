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

trait HasExternalId
{
    use GeneratesKey;

    public static function getSurrogateId(array $attributes): int
    {
        $self = static::where($attributes)->firstOrFail();

        return $self->id;
    }
}
