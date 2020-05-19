<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Mqtt;

final class MqttTopicHelper
{
    public const SEPARATOR = '/';

    public const WILDCARD_SINGLE = '+';

    public const WILDCARD_MULTI = '#';

    public static function resolve(...$levels)
    {
        $levels = is_array($levels[0]) ? $levels[0] : $levels;

        return implode(static::SEPARATOR, $levels);
    }
}
