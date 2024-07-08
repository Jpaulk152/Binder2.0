<?php

namespace Controllers\Routers;

use Controllers\ResourceController;
use Controllers\Routers\MediaRouter;
use Controllers\Routers\HTTP\Response;

class ResourceRouter extends Router
{
    public function __construct()
    {   
        // $this->default(ResourceController::class, 'media');
        
        $this->get('temp.css', ResourceController::class, 'stylesheet');
        $this->get('temp.js', ResourceController::class, 'jscripts');
        
        $this->get('app.css', ResourceController::class, 'css');
        $this->get('app.js', ResourceController::class, 'js');

        $this->addRoute('media', MediaRouter::class, 'GET');
    }


    // public function defaultAction()
    // {
    //     $this->printInfo(__FUNCTION__, $this->uri);

    //     parent::defaultAction();
    // }

    // public function controllerAction() : bool
    // {
    //     $this->printInfo(__FUNCTION__, $this->uri);

    //     return parent::controllerAction();
    // }

    public function routerAction($uri) : bool
    {
        $this->writeInfo(__FUNCTION__, $uri);

        return parent::routerAction($uri);
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



