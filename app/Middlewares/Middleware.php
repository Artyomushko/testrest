<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Middleware
{
    public function handle(ServerRequestInterface $request, callable $next, array $params = []): ResponseInterface;
}