<?php

namespace Tests\Helpers;

use App\Helpers\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function test_shake_to_camel()
    {
        $this->assertEquals('test', Str::snakeToCamel('test'));
        $this->assertEquals('testSnake', Str::snakeToCamel('test_snake'));
        $this->assertEquals('testSnake', Str::snakeToCamel('test__snake'));
    }
}