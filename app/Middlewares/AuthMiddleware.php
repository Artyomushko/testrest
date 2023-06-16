<?php

namespace App\Middlewares;

use App\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthMiddleware implements Middleware
{
    public function handle(ServerRequestInterface $request, callable $next, array $params = []): ResponseInterface
    {
        if (!isset($request->getCookieParams()['AUTH_USER_ID'])) {
            return (new ResponseFactory())
                ->createRedirectResponse('/login');
        }

        return $next(...$params);
    }
}