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
    private DeviceRepository $deviceRepository;

    public function __construct(Request $request)
    {
        $this->deviceRepository = new DeviceRepository($request->app());
    }

    public function store(
        Request $request,
        RegisterDevice $action,
        DeviceValidator $validator,
        string $deviceExternalId = null
    ): DeviceResource {
        $this->authorize('register', Device::class);

        if (
            $deviceExternalId &&
            $this->deviceRepository->existsByExternalId($deviceExternalId)
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

    public function show(string $deviceExternalId): DeviceResource
    {
        $device = $this->deviceRepository->findByExternalId($deviceExternalId);
        $this->authorize('read', $device, Device::buildNotFoundException($deviceExternalId));

        return DeviceResource::make($device);
    }
}
