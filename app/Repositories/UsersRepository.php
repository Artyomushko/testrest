<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends AbstractRepository
{
    public static function getModel(): string
    {
        return User::class;
    }
}