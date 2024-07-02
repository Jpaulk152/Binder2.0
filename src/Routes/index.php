<?php

namespace Routes;

use Controllers\IndexController;
use Controllers\IncludesController;
use Controllers\HomeController;
use Controllers\TableController;
use Controllers\TestController;
use Controllers\DashController;
use Controllers\ExampleController;
use Controllers\API\APIController;
use Controllers\API\ReadController;
use Controllers\API\HCController;
use Models\DB\CSVContext;
use Models\DB\DBContext;

use Routes\Router;

global $_csvContext;
global $_dbContext;

// $_csvContext = new CSVContext();
$_dbContext = new DBContext();

$router = new Router();

// Index
$router->get(\config::app_root(), IndexController::class, 'index');
$router->get(\config::app_root() . 'index', IndexController::class, 'index');

// Includes
$router->get(\config::app_root() . 'includes/app.css', IncludesController::class, 'stylesheet');
$router->get(\config::app_root() . 'includes/app.js', IncludesController::class, 'jscripts');

// Home
$router->get(\config::app_root(), HomeController::class, 'index');
$router->get(\config::app_root() . 'home', HomeController::class, 'index');
// $router->get(\config::public_root(). 'index.php/home/childView', HomeController::class, 'childView');

// Dashboard
$router->get(\config::app_root() . 'dash', DashController::class, 'index');
$router->get(\config::app_root() . 'info', DashController::class, 'info');

// API
$router->post(\config::app_root() . 'api/hc/menu', HCController::class, 'menu');
$router->post(\config::app_root() . 'api/hc/childMenu', HCController::class, 'childMenu');
$router->post(\config::app_root() . 'api/hc/pageContent', HCController::class, 'pageContent');

$router->post(\config::app_root() . 'app/read/table', ReadController::class, 'table');
$router->post(\config::app_root() . 'app/read/menu', ReadController::class, 'menu');
$router->post(\config::app_root() . 'app/read/pageContent', ReadController::class, 'pageContent');



$router->get(\config::app_root() . 'examples', ExampleController::class, 'index');




$router->dispatch();