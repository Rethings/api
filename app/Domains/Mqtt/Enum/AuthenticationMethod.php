<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Mqtt\Enum;

use Rethings\Support\Enum;

final class AuthenticationMethod extends Enum
{
    public const USERNAME = 'username';

    public const X509 = 'x509';

    public static function values(): array
    {
        return [
            self::USERNAME,
            self::X509,
        ];
    }
}
