<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Rethings\Support\LinkHelper;

class AppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'deactivatedAt' => $this->deactivatedAt ?? new MissingValue(),
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            '_links' => [
                LinkHelper::selfLink(route('apps.show', [$this->id], false)),
                LinkHelper::link('api-keys', route('apps.api-keys.index', [$this->id], false)),
            ],
        ];
    }
}
