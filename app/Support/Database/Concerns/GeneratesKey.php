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

use Illuminate\Support\Str;

trait GeneratesKey
{
    public static function generateKey(string $prefix = '', int $keyLength = null): string
    {
        $remaining = $keyLength ?? static::getKeyLength();
        $prefix = $prefix ?: static::getKeyPrefix();
        if (!empty($prefix)) {
            $remaining -= mb_strlen($prefix);
        }

        return $prefix . Str::random($remaining);
    }

    public static function getKeyPrefix(): string
    {
        return '';
    }

    public static function getKeyLength(): int
    {
        return 32;
    }
}
