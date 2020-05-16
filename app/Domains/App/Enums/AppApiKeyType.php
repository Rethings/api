<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\App\Enums;

use Rethings\Support\Enum;

final class AppApiKeyType extends Enum
{
    public const RESET = 'reset';

    public const SECRET = 'secret';

    public static function values(): array
    {
        return [
            self::RESET,
            self::SECRET,
        ];
    }
}
