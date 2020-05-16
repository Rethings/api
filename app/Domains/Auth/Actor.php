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

interface Actor
{
    public function getActorIdentifier(): string;

    public function getActorType(): ActorType;
}
