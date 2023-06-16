<?php

namespace App\Exceptions;

class PageNotFoundException extends \Exception
{
    protected $code = 404;

    protected $message = 'Page Not Found';
}