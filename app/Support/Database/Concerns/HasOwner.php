<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Database\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Rethings\Domains\Auth\Actor;
use Rethings\Domains\Auth\ActorType;
use Rethings\Domains\Auth\BaseActor;

trait HasOwner
{
    public function scopeByOwner(Builder $builder, Actor $actor): Builder
    {
        return $builder
            ->where($this->getOwnerIdColumn(), $actor->getActorIdentifier())
            ->where($this->getOwnerTypeColumn(), $actor->getActorType());
    }

    public function setOwner(Actor $owner): void
    {
        $this->attributes[$this->getOwnerIdColumn()] = $owner->getActorIdentifier();
        $this->attributes[$this->getOwnerTypeColumn()] = $owner->getActorType();
    }

    public function getOwner(): Actor
    {
        return new BaseActor(
            $this->attributes[$this->getOwnerIdColumn()],
            new ActorType($this->attributes[$this->getOwnerTypeColumn()])
        );
    }

    public function setOwnerAttribute(Actor $owner): void
    {
        $this->setOwner($owner);
    }

    public function getOwnerAttribute(): Actor
    {
        return $this->getOwner();
    }

    public function isOwnedBy(Actor $actor)
    {
        $owner = $this->getOwner();

        return $actor->getActorType()->is($owner->getActorType()->get()) &&
            $actor->getActorIdentifier() === $owner->getActorIdentifier();
    }

    private function getOwnerIdColumn(): string
    {
        return 'owner_id';
    }

    private function getOwnerTypeColumn(): string
    {
        return 'owner_type';
    }
}
