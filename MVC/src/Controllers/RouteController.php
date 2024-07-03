<?php

namespace Controllers;

use Controllers\Routers\Router;
use Controllers\Routers\IndexRouter;
use Controllers\Routers\APIRouter;
use Controllers\Routers\ResourceRouter;

use \utilities as u;

class RouteController extends Controller
{
    protected string $basePath = '/index.php/';

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

        $route = $this->getRoute();
        $method = $_SERVER['REQUEST_METHOD'];

        

        $router = '';
        if ($route[0] && array_key_exists($route[0], $this->routes))
        {
            $router = $this->routes[$route[0]];
            $router = new $router();
            if ($router->route($route[1], $method))
            {
                return;
            }
        }

        $router = $this->default;
        $router = new $router();
        $router->route($route[1], $method);
    }

    public function getRoute()
    {
        $uri = str_replace($this->basePath, '', $_SERVER['REQUEST_URI']);

        var_dump($_SERVER['REQUEST_URI']);
        var_dump(explode('/', $_SERVER['REQUEST_URI']));

        $route = [];
        $route[] = strtok($uri, '/');
        $route[] = substr($uri, strlen($route[0])+1);

        return $route;
    }
}

use Models\DB\DBContext;

global $_dbContext;
$_dbContext = new DBContext();

$routeController = new RouteController();