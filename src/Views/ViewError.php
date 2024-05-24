<?php

namespace Views;

use \ApplicationError;

class ViewError extends ApplicationError
{
    public function __construct($msg)
    {
        $this->errorType = 'View Error';
        parent::__construct($msg); 
    }
}