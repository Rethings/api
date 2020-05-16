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

class BaseActor implements Actor
{
    private string $identifier;

    private ActorType $type;

    public function __construct(string $identifier, ActorType $type)
    {
        $this->identifier = $identifier;
        $this->type = $type;
    }

    public function getActorIdentifier(): string
    {
        return $this->identifier;
    }

    public function getActorType(): ActorType
    {
        return $this->type;
    }
}
