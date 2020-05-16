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
use Rethings\Domains\App\Actions\CreateApiKey;
use Rethings\Domains\App\Actions\InvalidateApiKey;
use Rethings\Domains\App\App;
use Rethings\Domains\App\AppApiKeyValidator;
use Rethings\Domains\App\AppRepository;
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Http\Resources\AppApiKeyResource;

class AppApiKeyController extends Controller
{
    public function index(
        AppRepository $appRepository,
        string $appId
    ): AnonymousResourceCollection {
        $app = $appRepository->findActiveById($appId);
        $this->authorize('readApiKeys', $app, App::buildNotFoundException($appId));

        return AppApiKeyResource::collection($app->apiKeys()->withTrashed()->get());
    }

    public function show(
        AppRepository $appRepository,
        string $appId,
        string $apiKeyId
    ): AppApiKeyResource {
        $app = $appRepository->findActiveById($appId);
        $this->authorize('readApiKey', $app, App::buildNotFoundException($appId));

        $apiKey = $appRepository->findAppApiKey($appId, $apiKeyId);

        return AppApiKeyResource::make(
            $apiKey
        );
    }

    public function store(
        Request $request,
        AppRepository $appRepository,
        AppApiKeyValidator $validator,
        CreateApiKey $action,
        string $appId
    ): AppApiKeyResource {
        $app = $appRepository->findActiveById($appId);
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
        AppRepository $appRepository,
        InvalidateApiKey $action,
        string $appId,
        string $apiKeyId
    ): AppApiKeyResource {
        $app = $appRepository->findActiveById($appId);
        $this->authorize('invalidateApiKey', $app, App::buildNotFoundException($appId));

        $apiKey = $appRepository->findAppApiKey($appId, $apiKeyId);

        return AppApiKeyResource::make(
            $action->execute($apiKey)
        );
    }
}
