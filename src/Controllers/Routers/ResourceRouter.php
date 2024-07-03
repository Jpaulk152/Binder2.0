<?php

namespace Controllers\Routers;

use Controllers\ResourceController;
use Controllers\Routers\HTTP\Response;

class ResourceRouter extends Router
{
    public function __construct()
    {   

        parent::__construct(ResourceController::class, 'media');

        $this->get('app.css', ResourceController::class, 'stylesheet');
        $this->get('app.js', ResourceController::class, 'jscripts');
    }


    public function dispatch(string $controller, string $action, ?array $parameters=[]) : void
    {
        $controller = new $controller();
        if (!$controller->$action($parameters))
        {
            
                new Response('resource not found', 404);
            
        }




        
    }
}



