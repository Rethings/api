<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Device;

use Rethings\Rules\MetadataRule;
use Rethings\Support\Validations\ResourceValidator;

final class DeviceValidator extends ResourceValidator
{
    public function rules(array $data): array
    {
        return [
            'name' => ['nullable', 'string', 'min:1', 'max:255'],
            'metadata' => ['nullable', new MetadataRule()],
            'tags' => ['nullable', 'array', 'max:10'],
            'tags.*' => ['required', 'string', 'min:1', 'max:255'],
        ];
    }
}
