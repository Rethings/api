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
use Illuminate\Http\Response;
use Rethings\Domains\App\Actions\CreateApiKey;
use Rethings\Domains\App\Actions\DestroyApiKey;
use Rethings\Domains\App\App;
use Rethings\Domains\App\AppApiKeyValidator;
use Rethings\Domains\App\AppRepository;
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Http\Requests\DestroyRequest;
use Rethings\Http\Resources\AppApiKeyResource;

class AppApiKeyController extends Controller
{
    public function index(string $appId): AnonymousResourceCollection
    {
        $app = App::findOrFail($appId);
        $this->authorize('readApiKeys', $app, App::buildNotFoundException($appId));

        return AppApiKeyResource::collection($app->apiKeys()->withTrashed()->get());
    }

    public function show(
        AppRepository $appRepository,
        string $appId,
        string $apiKeyId
    ): AppApiKeyResource {
        $app = App::findOrFail($appId);
        $this->authorize('readApiKey', $app, App::buildNotFoundException($appId));

        $apiKey = $appRepository->findAppApiKey($appId, $apiKeyId);

        return AppApiKeyResource::make(
            $apiKey
        );
    }

    public function store(
        Request $request,
        AppApiKeyValidator $validator,
        CreateApiKey $action,
        string $appId
    ): AppApiKeyResource {
        $app = App::findOrFail($appId);
        $this->authorize('createApiKey', $app, App::buildNotFoundException($appId));

        $data = $validator->validate($request->all());

        return AppApiKeyResource::make(
            $action->execute(
                $app,
                $data['name'],
                new AppApiKeyType($data['type'])
            )
        );
    }

    public function destroy(
        DestroyRequest $request,
        AppRepository $appRepository,
        DestroyApiKey $action,
        string $appId,
        string $apiKeyId
    ): Response {
        $app = App::findOrFail($appId);
        $this->authorize('destroyApiKey', $app, App::buildNotFoundException($appId));

        $apiKey = $appRepository->findAppApiKey($appId, $apiKeyId);

        $action->execute($apiKey, (bool) $request->get('force', false));

        return response()->noContent();
    }
}
