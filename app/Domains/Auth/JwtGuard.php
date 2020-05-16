<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Auth;

use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RS256;
use Rethings\Domains\App\App;

class JwtGuard
{
    private AuthFactory $auth;

    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(Request $request)
    {
        if ($user = $this->auth->guard('web')->user()) {
            return $user;
        }

        $bearerToken = $request->bearerToken();
        if (!$bearerToken) {
            return null;
        }
        if ($request->hasApp()) {
            /** @var App $app */
            $app = $request->app();
            $publicKey = $app->publicKey;
            $actorType = new ActorType(ActorType::CONSUMER);
        } else {
            $publicKey = config('app.public_key');
            $actorType = new ActorType(ActorType::USER);
        }

        $jwt = (new Parser())->parse($bearerToken);
        if ($jwt->verify(new RS256(), $publicKey)) {
            return new JwtActor($jwt->getClaim('sub'), $actorType);
        }
    }
}
