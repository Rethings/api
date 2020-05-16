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

trait ForceMake
{
    public static function forceMake(array $attributes)
    {
        return (new static())->forceFill($attributes);
    }
}
