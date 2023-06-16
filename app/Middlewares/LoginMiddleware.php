<?php

namespace App\Middlewares;

use App\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginMiddleware implements Middleware
{
    public function handle(ServerRequestInterface $request, callable $next, array $params = []): ResponseInterface
    {
        if (isset($request->getCookieParams()['AUTH_USER_ID'])) {
            return (new ResponseFactory())
                ->createRedirectResponse('/profile');
        }

        if (!isset($request->getServerParams()['PHP_AUTH_USER'])) {
            return (new ResponseFactory())
                ->createLoginResponse();
        }

        return $next(...$params);
    }
}