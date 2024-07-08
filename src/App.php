<?php

use Controllers\API\HTTP\Response;
use Controllers\Routers\Router;
use Controllers\Routers\IndexRouter;

use Models\DB\DBContext;

use \utilities as u;

class App
{
    public Router $index;

    public function __construct()
    {
        u::writeLog('app started...', 'flowLog.txt');

        $GLOBALS['_dbContext'] = new DBContext();

        session_start();

        // u::printPathInfo();
        // die();

        $this->index = new IndexRouter();
        $this->index->route(isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '');

        

    }
}


