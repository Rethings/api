<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support;

use InvalidArgumentException;
use JsonSerializable;

abstract class Enum implements JsonSerializable
{
    private string $value;

    public function __construct(string $value)
    {
        if (!in_array($value, static::values(), true)) {
            throw new InvalidArgumentException("Unexpected value: $value");
        }

        $this->value = $value;
    }

    public function is(string ...$compare)
    {
        return in_array($this->value, $compare, true);
    }

    public function get(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->get();
    }

    public function jsonSerialize()
    {
        return $this->get();
    }

    public function equals(self $compare)
    {
        return $this->is($compare->get());
    }

    abstract public static function values(): array;
}
