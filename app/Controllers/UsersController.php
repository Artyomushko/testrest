<?php

namespace App\Controllers;

use App\Exceptions\ModelNotFoundException;
use App\Repositories\Repository;
use App\Repositories\UsersRepository;
use App\Resources\UserResource;
use Psr\Http\Message\ServerRequestInterface;

class UsersController extends Controller
{
    private Repository $repository;

    public function __construct()
    {
        $this->repository = new UsersRepository();
    }

    public function index(ServerRequestInterface $request): string
    {
        return json_encode(UserResource::collect($this->repository->getAll()));
    }

    public function show(ServerRequestInterface $request, $id): string
    {
        $user = $this->repository->getByKey($id);

        if (!$user) {
            throw new ModelNotFoundException();
        }

        return (new UserResource($user))->toJson();
    }
}