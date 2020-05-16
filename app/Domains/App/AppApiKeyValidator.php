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

use Illuminate\Validation\Rule;
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Support\Validations\ResourceValidator;

final class AppApiKeyValidator extends ResourceValidator
{
    public function rules(array $data): array
    {
        return [
            'type' => ['required', Rule::in(AppApiKeyType::values())],
            'name' => ['required', 'string', 'min:1', 'max:255'],
        ];
    }
}
