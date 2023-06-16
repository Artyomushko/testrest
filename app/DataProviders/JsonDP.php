<?php

namespace App\DataProviders;

use App\Models\Model;

class JsonDP extends AbstractDP
{
    public function __construct(string $fileName)
    {
        $this->data = json_decode(file_get_contents("storage/Json/{$fileName}.json"), true);
    }
}