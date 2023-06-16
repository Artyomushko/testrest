<?php

namespace App\Controllers;

use App\Http\ResponseFactory;
use App\Repositories\AdminRepository;
use App\Repositories\Repository;
use App\Resources\AdminResource;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends Controller
{
    private Repository $repository;

    public function __construct()
    {
        $this->repository = new AdminRepository;
    }

    public function login(ServerRequestInterface $request)
    {
        $login = $request->getServerParams()['PHP_AUTH_USER'];
        $password = $request->getServerParams()['PHP_AUTH_PW'];

        $admin = $this->repository->getByKey($login, 'login');
        if (!$admin || !password_verify($password, $admin->password)) {
            return (new ResponseFactory())->createLoginResponse();
        }

        setcookie('AUTH_USER_ID', $admin->getId());

        return (new AdminResource($admin))->toJson();
    }

    public function logout(ServerRequestInterface $request): ResponseInterface
    {
        setcookie('AUTH_USER_ID');

        return (new ResponseFactory())->createLoginResponse();
    }

    public function profile(ServerRequestInterface $request): string
    {
        $id = $request->getCookieParams()['AUTH_USER_ID'];

        $admin = $this->repository->getByKey($id, 'id');

        return (new AdminResource($admin))->toJson();
    }
}