<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Auth;

use Rethings\Support\Enum;

final class ActorType extends Enum
{
    public const USER = 'user';

    public const CONSUMER = 'consumer';

    public const CONSOLE = 'console';

    public static function values(): array
    {
        return [
            self::CONSUMER,
            self::USER,
            self::CONSOLE,
        ];
    }
}
