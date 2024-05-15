<?php

namespace Routes;

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
        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        $method = $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($uri, $this->routes[$method]))
        {

            $parameters = [];
            if($method == 'POST')
            {
                foreach($_POST as $key=>$value)
                {
                    $parameters[htmlspecialchars($key)] = htmlspecialchars($value);
                }
            }
            if($method == 'GET')
            {
                foreach($_GET as $key=>$value)
                {
                    $parameters[htmlspecialchars($key)] = htmlspecialchars($value);
                }
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