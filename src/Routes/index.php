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

// die(var_dump($_csvContext));

// die(var_dump($_dbContext->page));

// $context->page->add(page);
// $context->page->save();

// $_dbContext->types->set(['type_id'=>'5D', 'type_name'=>'SD']);
// $result = $_dbContext->page->fetchAll();


// die(var_dump($result));


// $_dbContext->query('SELECT * FROM types WHERE type_id = ? AND type_name = ?', '5D', 'SD')->fetchAll();

// die('here');

$router = new Router();

// echo \config::public_root();

// Home
$router->get(\config::public_root(), HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php', HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php/home', HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php/home/childView', HomeController::class, 'childView');


// Tables
$router->get(\config::public_root(). 'index.php/table', TableController::class, 'index');

// ClassLists
// $router->get(\config::public_root(). 'index.php/classLists', TableController::class, 'classLists');


// Tests
$router->get(\config::public_root(). 'index.php/test', TestController::class, 'index');
$router->get(\config::public_root(). 'index.php/test/fields', TestController::class, 'testFields');

// Dashboard
$router->get(\config::public_root(). 'index.php/dash', DashController::class, 'index');
$router->get(\config::public_root(). 'index.php/dash/test', DashController::class, 'testTemplate');
$router->get(\config::public_root(). 'index.php/info', DashController::class, 'info');


$router->dispatch();