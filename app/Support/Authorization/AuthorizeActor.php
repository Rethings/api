<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Authorization;

use Exception;
use Gate;
use Rethings\Domains\Auth\Actor;
use Rethings\Exceptions\AuthorizationException;

final class AuthorizeActor
{
    private Actor $actor;

    private string $action;

    private $resource;

    private Exception $exception;

    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }

    public function todo(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function for($resource): self
    {
        $this->resource = func_get_args();

        return $this;
    }

    public function throwOnFail(Exception $exception): self
    {
        $this->exception;

        return $this;
    }

    public function assert(): void
    {
        if (Gate::forUser($this->actor)
            ->denies(
                $this->action,
                ...$this->resource
            )
        ) {
            throw $this->exception ?? new AuthorizationException();
        }
    }
}
