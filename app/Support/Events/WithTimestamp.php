<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Events;

use DateTimeImmutable;

trait WithTimestamp
{
    private DateTimeImmutable $timestamp;

    public function getTimestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }
}
