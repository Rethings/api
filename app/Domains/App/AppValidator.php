<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\App;

use Rethings\Support\Validations\ResourceValidator;

final class AppValidator extends ResourceValidator
{
    public function rules(array $data): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'publicKey' => ['required', 'string', 'min:1'],
        ];
    }
}
