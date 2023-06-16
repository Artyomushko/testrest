<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository extends AbstractRepository
{
    public static function getModel(): string
    {
        return Admin::class;
    }
}