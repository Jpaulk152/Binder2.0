<?php

namespace Routes;

use \utilities as u;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method)
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, 'GET');
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, 'POST');
    }

    public function dispatch()
    {
        // echo '<body></body';
        // u::dd($_SERVER['REQUEST_URI']);

        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        $method = $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($uri, $this->routes[$method]))
        {
            $parameters = [];
            if($method == 'POST')
            {
                $parameters = filter_input_array(INPUT_POST);
            }
            if($method == 'GET')
            {
                $parameters = filter_input_array(INPUT_GET);
            }

            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];

            $controller = new $controller();
            $controller->$action($parameters);
        }
        else
        {
            // hand API redirections

            $home = new \Controllers\HomeController();

            $home->redirect($uri);
            

            // throw new \Exception('No route found for URI: ' . $uri);
        }
    }
}