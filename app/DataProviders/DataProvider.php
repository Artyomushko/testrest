<?php

namespace App\DataProviders;

use App\Models\Model;

interface DataProvider
{
    public function getAll(): array;

    public function getByKey(string $key, string $field): ?array;
}