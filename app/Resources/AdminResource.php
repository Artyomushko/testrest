<?php

namespace App\Resources;

use App\Models\Admin;

class AdminResource extends AbstractResource
{
    public function toArray(): array
    {
        return [
            'login' => $this->resource->getLogin(),
        ];
    }
}