<?php

namespace Controllers;

use Controllers\Routers\Router;
use Controllers\Routers\IndexRouter;
use Controllers\Routers\APIRouter;
use Controllers\Routers\ResourceRouter;

use \utilities as u;

class RouteController extends Controller
{
    public string $default = IndexRouter::class;

    protected array $routes = [
        'default'   =>  IndexRouter::class,
        'resources' =>  ResourceRouter::class,
        'media'     =>  ResourceRouter::class,
        'api'       =>  APIRouter::class,
        'app'       =>  APIRouter::class
    ];

    public function __construct()
    {
        parent::__construct();
        session_start();

        $router = $this->default;

        $route = $this->getRoute();
        $method = $_SERVER['REQUEST_METHOD'];

        // case: hostname/index.php/router/uri and the router is mapped
        if ($route['root'] && $route['router'] && $route['uri'] && array_key_exists($route['router'], $this->routes))
        {
            $router = $this->routes[$route['router']];
        }
        else
        {
            // case: hostname/index.php/router/uri and router is not mapped
            if ($route['uri'])
            {
                $route['uri'] = $route['router'] . '/' . $route['uri'];
            }
            // case: hostname/index.php/router and router is not mapped
            else if ($route['router'])
            {
                $route['uri'] = $route['router'];
            }
        }


        $router = new $router();

        if ($router->route($route['uri'], $method))
        {
            return;
        }


        echo 'could not find route<br>';
        var_dump($route);

    }

    public function getRoute()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        $route = [];
        $route['root'] = strtok($uri, '/');
        if ($route['root'])
        {
            $route['router'] = strtok('/');
            if ($route['router'])
            {
                $route['uri'] = substr($uri, strlen('/'.$route['root'].'/'.$route['router'].'/'));
            }
            else
            {
                $route['uri'] = false;
            }
        }
        else
        {
            $route['router'] = false;
            $route['uri'] = false;
        }

        return $route;
    }
}

use Models\DB\DBContext;

global $_dbContext;
$_dbContext = new DBContext();

$routeController = new RouteController();











// class RouteController
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