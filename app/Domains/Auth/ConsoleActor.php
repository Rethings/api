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

class ConsoleActor extends BaseActor
{
    public function __construct()
    {
        parent::__construct('console', new ActorType(ActorType::CONSOLE));
    }
}
