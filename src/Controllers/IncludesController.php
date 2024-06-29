<?php

namespace Controllers;

use \utilities as u;
use Controllers\API\HTTP\Response;

class IncludesController extends Controller
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
        }
        else
        {
            new Response('', 200, 'text/css');
        }
    }

    public function jscripts()
    {
        if (isset($_SESSION['jscripts']))
        {
            new Response($_SESSION['jscripts'], 200, 'text/javascript');
        }
        else
        {
            new Response('', 200, 'text/javascript');
        }
    }
}