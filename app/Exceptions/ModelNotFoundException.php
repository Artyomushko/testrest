<?php

namespace App\Exceptions;

class ModelNotFoundException extends \Exception
{
    protected $code = 404;

    protected $message = 'Model Not Found';
}