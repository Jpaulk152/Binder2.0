<?php

namespace Routes;

use Controllers\HomeController;
use Controllers\CurriculumController;
use Controllers\PageController;
use Controllers\ContentController;
use Controllers\ClassListController;
use Controllers\RendersController;
use Controllers\TestController;


use Models\DB\CSVContext;
use Models\DB\DBContext;

use Routes\Router;

global $_csvContext;
global $_dbContext;

$_csvContext = new CSVContext();
$_dbContext = new DBContext();


// die();


// die(var_dump($GLOBALS));



$router = new Router();

// echo \config::public_root();

// Home
$router->get(\config::public_root(), HomeController::class, 'home');
$router->get(\config::public_root(). 'index.php', HomeController::class, 'home');
$router->get(\config::public_root(). 'index.php/home', HomeController::class, 'home');
$router->get(\config::public_root(). 'index.php/test', HomeController::class, 'test');

// Pages
$router->get(\config::public_root(). 'index.php/pages', PageController::class, 'index');
$router->get(\config::public_root(). 'index.php/pages/detail', PageController::class, 'detail');

// ClassLists
$router->get(\config::public_root(). 'index.php/classLists', ClassListController::class, 'index');
$router->get(\config::public_root(). 'index.php/classLists/detail', ClassListController::class, 'detail');


// Tests
$router->get(\config::public_root(). 'index.php/test', TestController::class, 'index');
$router->get(\config::public_root(). 'index.php/test1', TestController::class, 'test1');
$router->get(\config::public_root(). 'index.php/test2', TestController::class, 'test2');
$router->get(\config::public_root(). 'index.php/info', TestController::class, 'info');

$router->dispatch();