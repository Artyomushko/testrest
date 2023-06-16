<?php

namespace App\DataProviders;

class CsvDP extends AbstractDP
{
    public function __construct(string $fileName)
    {
        $stream = fopen("storage/Csv/{$fileName}.csv", 'r');
        $keys = fgetcsv($stream);
        while ($row = fgetcsv($stream)) {
            $this->data[] = array_combine($keys, $row);
        }
    }
}