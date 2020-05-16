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

final class AppStatus extends Enum
{
    public const ACTIVE = 'active';

    public const INACTIVE = 'inactive';

    public static function values(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
        ];
    }
}
