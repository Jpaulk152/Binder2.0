<?php

namespace Controllers\Routers;

use Controllers\IndexController;
use Controllers\HomeController;
use Controllers\ResourceController;
use Controllers\TestController;
use Controllers\DashController;
use Controllers\ExampleController;
use Controllers\API\ReadController;
use Controllers\API\HCController;
use Controllers\API\HTTP\Response;
use \utilities as u;

class IndexRouter extends Router
{
    public function __construct()
    {
        $this->default(IndexController::class, 'redirect');

        // Home
        $this->get('home', HomeController::class, 'index');

        // Examples
        $this->get('examples', ExampleController::class, 'index');

        // Test
        $this->get('test', TestController::class, 'index');

        // Dashboard
        $this->get('dash', DashController::class, 'index');
        $this->get('info', DashController::class, 'info');

        $this->addRoute('resources', ResourceRouter::class, 'GET');
        $this->addRoute('media', MediaRouter::class, 'GET');
        $this->addRoute('api', APIRouter::class, 'POST');
        $this->addRoute('app', APIRouter::class, 'POST');
    }


    public function defaultAction()
    {
        $controller = new IndexController();
        $controller->redirect();
    }

    // public function controllerAction() : bool
    // {
    //     new Response($this->printInfo(__FUNCTION__, $this->uri));

    //     return parent::controllerAction();
    // }

    // public function routerAction($uri) : bool
    // {
    //     new Response($this->printInfo(__FUNCTION__, $uri), 200, 'text/html');

    //     return parent::routerAction($uri);
    // }


    // public function defaultAction()
    // {
    //     $controller = $this->controllers['GET']['default']['controller'];
    //     $action = $this->controllers['GET']['default']['action'];

    //     $this->controllerAction($controller, $action);

    //     return true;
    // }

}



