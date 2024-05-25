<?php

namespace Views;

use \ApplicationError;
use \utilities as u;

class ViewError extends ApplicationError
{
    public function __construct($msg)
    {
        // echo '<body></body>';
        // u::dd(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10));



        $this->errorType = 'View Error';
        parent::__construct($msg); 
    }
}