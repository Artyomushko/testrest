<?php

namespace App\DataProviders;

use App\Models\Model;

class ArrayDP extends AbstractDP
{
    public function __construct(string $fileName)
    {
        $this->data = include "storage/Array/{$fileName}.php";
    }
}