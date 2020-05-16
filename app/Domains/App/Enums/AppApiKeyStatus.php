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

final class AppApiKeyStatus extends Enum
{
    public const ACTIVE = 'active';

    public const INVALIDATED = 'invalidated';

    public static function values(): array
    {
        return [
            self::ACTIVE,
            self::INVALIDATED,
        ];
    }
}
