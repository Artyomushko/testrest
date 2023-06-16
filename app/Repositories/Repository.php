<?php

namespace App\Repositories;

use App\Models\Model;

interface Repository
{
    public function getAll(): array;

    public function getByKey(string $id, string $key = 'id'): ?Model;

    public static function getModel(): string;
}