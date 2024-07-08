<?php

namespace Controllers\Routers;

use Controllers\API\ReadController;
use Controllers\API\HCController;
use Controllers\HomeController;

use Controllers\Routers\HTTP\Response;

class APIRouter extends Router
{
    public function __construct()
    {
        // $this->get('test', HomeController::class, 'index');

        $this->post('hc/menu', HCController::class, 'menu');
        $this->post('hc/childMenu', HCController::class, 'childMenu');
        $this->post('hc/pageContent', HCController::class, 'pageContent');

        $this->post('read/table', ReadController::class, 'table');
        $this->post('read/menu', ReadController::class, 'menu');
        $this->post('read/pageContent', ReadController::class, 'pageContent');
    }


    // public function controllerAction() : bool
    // {


        

    //     new Response($this->printInfo(__FUNCTION__, $this->uri), 404);
    //     // $this->printInfo(__FUNCTION__, $this->uri, $controllers, $actions);

    //     return parent::controllerAction();
    // }

    // public function routerAction($uri) : bool
    // {
    //     new Response($this->printInfo(__FUNCTION__, $this->uri), 404);

    //     return parent::routerAction($uri);
    // }

    // public function dispatch(string $controller, string $action, ?array $parameters=[]) : void
    // {
    //     $controller = new $controller();
    //     if (!$controller->$action($parameters))
    //     {
    //         new Response('resource not found', 404);   
    //     }
    // }

    // public function getURI() : string
    // {
    //     $uri = strtok($_SERVER['PATH_INFO'], '/');        
    //     $uri = substr($_SERVER['PATH_INFO'], strlen('/'.$uri.'/'));

    //     return $uri;
    // }
}



