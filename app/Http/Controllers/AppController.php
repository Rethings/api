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
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Rethings\Domains\App\Actions\CreateApp;
use Rethings\Domains\App\Actions\DeactivateApp;
use Rethings\Domains\App\Actions\RestoreApp;
use Rethings\Domains\App\Actions\UpdateApp;
use Rethings\Domains\App\App;
use Rethings\Domains\App\AppRepository;
use Rethings\Domains\App\AppValidator;
use Rethings\Http\Resources\AppResource;

class AppController extends Controller
{
    public function index(Request $request, AppRepository $appRepository): AnonymousResourceCollection
    {
        $actor = $request->user();

        return AppResource::collection(
            $appRepository->getAllLiveByActor($actor)
        );
    }

    public function store(Request $request, CreateApp $action, AppValidator $validator): AppResource
    {
        $this->authorize('create', App::class);

        $actor = $request->user();
        $data = $validator->validate($request->all());

        return AppResource::make(
            $action->execute(
                $actor,
                App::generateKey(),
                $data['name'],
                $data['publicKey']
            )
        );
    }

    public function show(string $appId): AppResource
    {
        $app = App::findOrFail($appId);
        $this->authorize('read', $app);

        return AppResource::make($app);
    }

    public function update(
        AppRepository $appRepository,
        Request $request,
        UpdateApp $action,
        AppValidator $validator,
        string $appId
    ): AppResource {
        $app = $appRepository->findActiveById($appId);
        $this->authorize('update', $app);

        $data = $request->all() + $app->toArray();
        $data = $validator->validate($data);

        return AppResource::make(
            $action->execute(
                $app,
                $data['name'],
                $data['publicKey']
            )
        );
    }

    public function destroy(DeactivateApp $action, string $appId): AppResource
    {
        $app = App::findOrFail($appId);
        $this->authorize('deactivate', $app);

        return AppResource::make(
            $action->execute($app)
        );
    }

    public function restore(RestoreApp $action, string $appId)
    {
        $app = App::findOrFail($appId);
        $this->authorize('restore', $app);

        return AppResource::make(
            $action->execute($app)
        );
    }
}
