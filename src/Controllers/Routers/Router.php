<?php

namespace Controllers\Routers;

use Controllers\HomeController;

abstract class Router
{
    protected string $defaultController = HomeController::class;

    protected array $routes = ['GET'=>[], 'POST'=>[]];


    public function __construct(string $controller, string $action)
    {
        $this->get('default', $controller, $action);
    }

    public function get(string $route, string $controller, string $action) : void
    {
        $this->addRoute($route, $controller, $action, 'GET');
    }

    public function post(string $route, string $controller, string $action) : void
    {
        $this->addRoute($route, $controller, $action, 'POST');
    }

    private function addRoute(string $route, string $controller, string $action, string $method) : void
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function dispatch(string $controller, string $action, ?array $parameters=[]) : void
    {
        $controller = new $controller();
        $controller->$action($parameters);
    }

    public function route(string $uri, string $method) : bool
    {
      // var_dump($uri);
        // die();

        $controller = '';
        $action = '';
        $parameters = [];

        if (array_key_exists($uri, $this->routes[$method]))
        {
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];
        }
        else if (array_key_exists('default', $this->routes['GET']))
        {
            $controller = $this->routes['GET']['default']['controller'];
            $action = $this->routes['GET']['default']['action'];
        }
        else
        {
            return false;
        }

        if($method == 'POST')
        {
            $parameters = filter_input_array(INPUT_POST);
        }
        if($method == 'GET')
        {
            $parameters = filter_input_array(INPUT_GET);
        }

        $this->dispatch($controller, $action, $parameters);

        return true;
    }
}



// abstract class Router
// {
//     protected string $defaultController = HomeController::class;

//     protected array $routes = ['GET'=>[], 'POST'=>[]];


//     public function __construct(string $controller, string $action)
//     {
//         $this->get('default', $controller, $action);
//     }


//     public function get(string $route, string $controller, string $action) : void
//     {
//         $this->addRoute($route, $controller, $action, 'GET');
//     }

//     public function post(string $route, string $controller, string $action) : void
//     {
//         $this->addRoute($route, $controller, $action, 'POST');
//     }

//     private function addRoute(string $route, string $controller, string $action, string $method) : void
//     {
//         $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
//     }

//     public function getURI() : string
//     {
//         return strtok($_SERVER['REQUEST_URI'], '?');
//     }

//     public function redirect() : void
//     {
//         $controller = $this->defaultController;
//         $controller = new $controller();

//         $controller->index();
//     }

//     public function dispatch($uri, $method) : void
//     {
//         $uri = $this->getURI();
//         $method = $_SERVER['REQUEST_METHOD'];

//         // var_dump($uri);
//         // die();

//         if (array_key_exists($uri, $this->routes[$method]))
//         {
//             $parameters = [];
//             if($method == 'POST')
//             {
//                 $parameters = filter_input_array(INPUT_POST);
//             }
//             if($method == 'GET')
//             {
//                 $parameters = filter_input_array(INPUT_GET);
//             }

//             $controller = $this->routes[$method][$uri]['controller'];
//             $action = $this->routes[$method][$uri]['action'];

//             $controller = new $controller();
//             $controller->$action($parameters);
//         }
//         else
//         {
//             $this->redirect();
//         }
//     }
    
// }