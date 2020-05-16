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

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait CamelCasedAttributes
{
    public static function bootCamelCasedAttributes(): void
    {
        static::$snakeAttributes = false;
    }

    public function getAttribute($key)
    {
        if (method_exists($this, $key)) {
            return $this->getRelationValue($key);
        }

        return parent::getAttribute($this->getSnakeKey($key));
    }

    public function setAttribute($key, $value)
    {
        return parent::setAttribute($this->getSnakeKey($key), $value);
    }

    protected function getSnakeKey($key)
    {
        return Str::snake($key);
    }

    public function getDates()
    {
        return $this->getSnakeCasedArray(parent::getDates());
    }

    public function getVisible()
    {
        return $this->getSnakeCasedArray(parent::getVisible());
    }

    public function getHidden()
    {
        return $this->getSnakeCasedArray(parent::getHidden());
    }

    public function getArrayableAppends()
    {
        if (!count($this->appends)) {
            return [];
        }

        $appends = $this->getSnakeCasedArray($this->appends);

        return $this->getArrayableItems(
            array_combine($appends, $appends)
        );
    }

    protected function getSnakeCasedArray(array $array)
    {
        return array_map(function ($value) {
            return Str::snake($value);
        }, $array);
    }

    public function toArray(): array
    {
        return Arr::camelCaseKeys(parent::toArray());
    }
}
