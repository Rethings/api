<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Validations;

use Illuminate\Contracts\Validation\Validator;

abstract class ResourceValidator
{
    abstract public function rules(array $data): array;

    public function postValidation(Validator $validator, array $data): void
    {
    }

    public function messages(array $data): array
    {
        return [];
    }

    public function customAttributes(array $data): array
    {
        return [];
    }

    public function get($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function validate($data)
    {
        $validator = validator()
            ->make(
                $data,
                $this->rules($data),
                $this->messages($data),
                $this->customAttributes($data)
            );
        $validator->after(function (Validator $validator) use ($data): void {
            $this->postValidation($validator, $data);
        });

        return $validator->validate();
    }
}
