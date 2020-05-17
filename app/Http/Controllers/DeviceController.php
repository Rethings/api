<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Rethings\Domains\Device\Actions\RegisterDevice;
use Rethings\Domains\Device\Device;
use Rethings\Domains\Device\DeviceRepository;
use Rethings\Domains\Device\DeviceValidator;
use Rethings\Http\Resources\DeviceResource;

class DeviceController extends Controller
{
    public function store(
        DeviceRepository $deviceRepository,
        Request $request,
        RegisterDevice $action,
        DeviceValidator $validator,
        string $deviceExternalId = null
    ) {
        $this->authorize('register', Device::class);

        if (
            $deviceExternalId &&
            $deviceRepository->existsByExternalId($deviceExternalId, $request->getAppId())
        ) {
            throw ValidationException::withMessages([
                'id' => trans('validation.exists_external_id', ['resource' => 'Device']),
            ]);
        }

        $data = $validator->validate($request->all());

        return DeviceResource::make(
            $action->execute(
                $request->user(),
                $request->getAppId(),
                $deviceExternalId ?? Device::generateKey(),
                $data['name'] ?? null,
                $data['metadata'] ?? [],
                $data['tags'] ?? []
            )
        );
    }

    public function show(Request $request, string $deviceExternalId): void
    {
    }
}
