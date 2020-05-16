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

class AppApiKeyResource extends JsonResource
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
            'key' => $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'status' => $this->status,
            'invalidatedAt' => $this->invalidatedAt ?? new MissingValue(),
            'createdAt' => $this->createdAt,
            '_links' => [
                LinkHelper::link('app', route('apps.show', [$this->app->id], false)),
            ],
        ];
    }
}
