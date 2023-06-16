<?php

namespace App;

use App\Controllers\AuthController;
use App\Controllers\UsersController;
use App\Exceptions\MethodNotAllowedException;
use App\Exceptions\PageNotFoundException;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\LoginMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    private array $routes = [
        'users'      => [
            'get' => [
                'callback'   => [UsersController::class, 'index'],
                'middleware' => AuthMiddleware::class,
            ],
        ],
        'users/{id}' => [
            'get' => [
                'callback'   => [UsersController::class, 'show'],
                'middleware' => AuthMiddleware::class,
            ],
        ],
        'login'      => [
            'get' => [
                'callback' => [AuthController::class, 'login'],
                'middleware' => LoginMiddleware::class,
            ],
        ],
        'logout'     => [
            'get' => [
                'callback' => [AuthController::class, 'logout'],
                'middleware' => AuthMiddleware::class,
            ],
        ],
        'profile'    => [
            'get' => [
                'callback' => [AuthController::class, 'profile'],
                'middleware' => AuthMiddleware::class,
            ],
        ],
    ];

    /**
     * @param ServerRequestInterface $request
     *
     * @return string
     * @throws MethodNotAllowedException
     * @throws PageNotFoundException
     */
    public function call(ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->routes as $route => $methods) {
            $routeObject = new Route($route, $methods);
            if ($routeObject->checkPath($request->getUri()->getPath(), $request->getMethod())) {
                return $routeObject->call($request);
            }
        }

        throw new PageNotFoundException();
    }
}