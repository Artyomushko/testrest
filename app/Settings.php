<?php

namespace App;

use App\DataProviders\CsvDP;

class Settings
{
    public static string $dataProviderClass = CsvDP::class;
}