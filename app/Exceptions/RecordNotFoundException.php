<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

final class RecordNotFoundException extends Exception implements HttpExceptionInterface
{
    public function __construct($message = 'Record not found.', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode()
    {
        return Response::HTTP_NOT_FOUND;
    }

    public function getHeaders()
    {
        return [];
    }

    public static function forModel(string $modelClass): self
    {
        $modelName = basename($modelClass);

        return new static("$modelName not found");
    }
}
