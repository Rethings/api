<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Mixins;

class BlueprintMixin
{
    public function actor(): callable
    {
        return function (string $name, string $indexName = null): void {
            $this->string("{$name}_id");

            $this->string("{$name}_type");

            $this->index(["{$name}_type", "{$name}_id"], $indexName);
        };
    }

    public function stringMorphs(): callable
    {
        return function (string $name, $indexName = null): void {
            $this->string("{$name}_type");

            $this->string("{$name}_id");

            $this->index(["{$name}_type", "{$name}_id"], $indexName);
        };
    }

    public function nullableStringMorphs(): callable
    {
        return function (string $name, $indexName = null): void {
            $this->string("{$name}_type")->nullable();

            $this->string("{$name}_id")->nullable();

            $this->index(["{$name}_type", "{$name}_id"], $indexName);
        };
    }
}
