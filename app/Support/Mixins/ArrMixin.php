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

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class ArrMixin
{
    public function undot(): callable
    {
        return function (iterable $array): array {
            $newArray = [];

            foreach ($array as $key => $value) {
                Arr::set($newArray, $key, $value);
            }

            return $newArray;
        };
    }

    public function camelCaseKeys(): callable
    {
        return function (iterable $array): array {
            $ret = [];
            foreach ($array as $key => $value) {
                $ret[Str::camel($key)] = is_iterable($value) ? Arr::camelCaseKeys($value) : $value;
            }

            return $ret;
        };
    }
}
