<?php

namespace Controllers;

use \utilities as u;
use Controllers\API\HTTP\Response;

class ResourceController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function stylesheet()
    {
        if (isset($_SESSION['stylesheet']))
        {
            new Response($_SESSION['stylesheet'], 200, 'text/css');
            return true;
        }
        else
        {
            return false;
        }
    }

    public function jscripts()
    {
        if (isset($_SESSION['jscripts']))
        {
            new Response($_SESSION['jscripts'], 200, 'text/javascript');
            return true;
        }
        else
        {
            return false;
        }
    }

    public function media()
    {
        // var_dump($_SERVER['REQUEST_URI']);

        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        $route = [];
        $route['root'] = strtok($uri, '/');
        if ($route['root'])
        {

            $route['uri'] = substr($uri, strlen('/'.$route['root']));

            if(file_exists( 'public'.$route['uri']))
            {
                new Response(file_get_contents('public'.$route['uri']), 200, 'text/html');
                return true;
            }
            else
            {
                return false;
            }

        }
    }

}