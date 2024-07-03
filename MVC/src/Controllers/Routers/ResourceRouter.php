<?php

namespace Controllers\Routers;

use Controllers\ResourceController;

class ResourceRouter extends Router
{
    public function __construct()
    {        
        $this->get(\config::app_root() . 'resources/app.css', ResourceController::class, 'stylesheet');
        $this->get(\config::app_root() . 'resources/app.js', ResourceController::class, 'jscripts');
    }
}



