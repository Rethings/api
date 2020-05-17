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

trait StringKey
{
    use GeneratesKey;

    public static function bootStringKey(): void
    {
        static::creating(function (self $model): void {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = $model->generateKey();
            }
        });
    }

    /**
     * Laravel Eloquent override.
     */
    public function isIncrementing(): bool
    {
        return false;
    }

    /**
     * Laravel Eloquent override.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }
}
