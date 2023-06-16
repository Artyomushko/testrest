<?php

namespace App\Exceptions;

class MethodNotAllowedException extends \Exception
{
    protected $code = 405;

    protected $message = 'Method Not Allowed';
}