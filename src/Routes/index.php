<?php

namespace Routes;

use Controllers\HomeController;
use Controllers\TableController;
use Controllers\TestController;
use Controllers\DashController;


use Models\DB\CSVContext;
use Models\DB\DBContext;

use Routes\Router;

global $_csvContext;
global $_dbContext;

$_csvContext = new CSVContext();
$_dbContext = new DBContext();

$router = new Router();

// echo \config::public_root();

// Home
$router->get(\config::public_root(), HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php', HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php/home', HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php/home/childView', HomeController::class, 'childView');


// Pages
$router->get(\config::public_root(). 'index.php/pages', TableController::class, 'pages');

// ClassLists
$router->get(\config::public_root(). 'index.php/classLists', TableController::class, 'classLists');


// Tests
$router->get(\config::public_root(). 'index.php/test', TestController::class, 'index');
$router->get(\config::public_root(). 'index.php/test1', TestController::class, 'test1');
$router->get(\config::public_root(). 'index.php/test2', TestController::class, 'test2');
$router->get(\config::public_root(). 'index.php/test3', TestController::class, 'test3');
$router->get(\config::public_root(). 'index.php/info', TestController::class, 'info');

// Dashboard
$router->get(\config::public_root(). 'index.php/dash', DashController::class, 'index');
$router->get(\config::public_root(). 'index.php/info', DashController::class, 'info');


$router->dispatch();