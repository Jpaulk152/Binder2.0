<?php

// namespace Controllers;


// use Controllers\Routers\Router;
// use Controllers\Routers\IndexRouter;
// use Controllers\Routers\APIRouter;
// use Controllers\Routers\ResourceRouter;

// use \utilities as u;

// class RouteController extends Controller
// {
//     public string $default = IndexRouter::class;

//     protected array $routes = [
//         'default'   =>  IndexRouter::class,
//         'resources' =>  ResourceRouter::class,
//         'media'     =>  ResourceRouter::class,
//         'api'       =>  APIRouter::class,
//         'app'       =>  APIRouter::class
//     ];

//     public function __construct()
//     {
//         parent::__construct();
//         session_start();

//         $router = $this->default;

//         $route = $this->getRoute();
//         $method = $_SERVER['REQUEST_METHOD'];

//         //hcexp.dev.holmcenter.com/MVC2/index.php/home


//         // case: hostname

//         // case: hostname/script

//         // case: hostname/script/

//         // case: hostname/script/home

//         // case: hostname/script/router

//         // case: hostname/script/router/uri



//         // case: hostname/index.php/router/uri and the router is mapped
//         if ($route['root'] && $route['router'] && $route['uri'] && array_key_exists($route['router'], $this->routes))
//         {
//             $router = $this->routes[$route['router']];
//         }
//         else
//         {
//             // case: hostname/index.php/router/uri and router is not mapped
//             if ($route['uri'])
//             {
//                 $route['uri'] = $route['router'] . '/' . $route['uri'];
//             }
//             // case: hostname/index.php/router and router is not mapped
//             else if ($route['router'])
//             {
//                 $route['uri'] = $route['router'];
//             }
//         }


//         $router = new $router();

//         if ($router->route($route['uri'], $method))
//         {
//             return;
//         }


//         echo 'could not find route<br>';
//         var_dump($route);

//     }

//     public function getRoute()
//     {
//         $uri = strtok($_SERVER['REQUEST_URI'], '?');

//         $route = [];
//         $route['root'] = strtok($uri, '/');

//         echo $route['root'];

//         u::printPathInfo();

//         if ($route['root'])
//         {
//             $route['router'] = strtok('/');
//             if ($route['router'])
//             {
//                 $route['uri'] = substr($uri, strlen('/'.$route['root'].'/'.$route['router'].'/'));
//             }
//             else
//             {
//                 $route['uri'] = false;
//             }
//         }
//         else
//         {
//             $route['router'] = false;
//             $route['uri'] = false;
//         }

//         return $route;
//     }
// }
