<?php

namespace Controllers\Routers;

use Controllers\API\HTTP\Response;
use Controllers\HomeController;
use \utilities as u;

abstract class Router
{
    protected string $defaultController = HomeController::class;

    protected array $routes = ['GET'=>[], 'POST'=>[]];
    protected array $controllers = ['GET'=>[], 'POST'=>[]];

    protected $uri;
    protected string $method;
    protected string $router;

   
    public function dispatch(string $controller, string $action, ?array $parameters=[]) : void
    {
        $controller = new $controller();
        $controller->$action($parameters);
    }


    public function controllerAction() : bool
    {

        if (array_key_exists($this->uri, $this->controllers[$this->method]))
        {
            

            $controller = $this->controllers[$this->method][$this->uri]['controller'];
            $action = $this->controllers[$this->method][$this->uri]['action'];

            $parameters = [];
            if($this->method == 'POST')
            {
                $parameters = filter_input_array(INPUT_POST);
            }
            if($this->method == 'GET')
            {
                $parameters = filter_input_array(INPUT_GET);
            }
    
            $this->dispatch($controller, $action, $parameters);

            return true;
        }

        return false;
       
    }

    public function routerAction($uri) : bool
    {   
        $path = explode('/', $uri);

        if (!empty($path) && array_key_exists($path[0], $this->routes[$this->method]))
        {

            $router = $this->routes[$this->method][$path[0]];

            $router = new $router();
            
            return $router->route($this->nextSegment($uri));
        }

        return false;
    }

    public function defaultAction()
    {
        $this->printInfo(__FUNCTION__);
    }

    public function printInfo($func, ...$info)
    {
        echo '<br>Testing...<br>';
        echo 'class: '.get_class($this).'<br>';
        echo 'function: '.$func.'<br>';

        foreach($info as $item)
        {
            echo $item.'<br>';
        }

        echo '<br>';
    }

    public function writeInfo($func, ...$info)
    {
        $msg = '<br>Testing...\n';
        $msg .= 'class: '.get_class($this).'\n';
        $msg .=  'function: '.$func.'\n';

        foreach($info as $item)
        {
            $msg .= $item.'\n';
        }

        $msg .= '\n';

        u::writeLog($msg, 'Router.txt');
    }


    public function nextSegment(string $uri)
    {
        $path = explode('/', $uri);
        $uri = implode('/', array_slice($path, 1));
        if(empty($uri))
        {
            return false;
        }
        return $uri;
    }


    public function route($uri)
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        if ($uri && strtok($uri, '/'))
        {


            $this->uri = ltrim(rtrim($uri, '/'), '/');

            // $this->printInfo(__FUNCTION__, $this->uri);

            if ($this->controllerAction())
            {
                return true;
            }

            if (!$this->routerAction($this->uri))
            {
                $uri = $this->nextSegment($this->uri);
                do{
                    if ($this->routerAction($uri))
                    {
                        return true;
                        break;
                    }
                }while($uri = $this->nextSegment($uri));
                
            }
            return false;
        }
        else
        {
            $this->defaultAction();
        }
    }



    public function default(string $controller, string $action)
    {
        $this->get('default', $controller, $action);
    }

    public function get(string $route, string $controller, string $action) : void
    {
        $this->addController($route, $controller, $action, 'GET');
    }

    public function post(string $route, string $controller, string $action) : void
    {
        $this->addController($route, $controller, $action, 'POST');
    }

    private function addController(string $route, string $controller, string $action, string $method) : void
    {
        $this->controllers[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    protected function addRoute(string $route, string $router, string $method) : void
    {
        $this->routes[$method][$route] = $router;
    }
}