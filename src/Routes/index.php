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
$router->get(\config::public_root(), HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php', HomeController::class, 'home');
$router->get(\config::public_root(). 'index.php/home', HomeController::class, 'home');
$router->get(\config::public_root(). 'index.php/journal', HomeController::class, 'journal');

// Curriculum
$router->get(\config::public_root(). 'index.php/curriculum', CurriculumController::class, 'home');
$router->get(\config::public_root(). 'index.php/curriculum/home', CurriculumController::class, 'home');


// Pages
$router->get(\config::public_root(). 'index.php/pages', PageController::class, 'index');
$router->get(\config::public_root(). 'index.php/pages/detail', PageController::class, 'detail');

// Content
$router->get(\config::public_root(). 'index.php/content', ContentController::class, 'index');
$router->get(\config::public_root(). 'index.php/content/detail', ContentController::class, 'detail');

// ClassLists
$router->get(\config::public_root(). 'index.php/classLists', ClassListController::class, 'index');
$router->get(\config::public_root(). 'index.php/classLists/detail', ClassListController::class, 'detail');


// Renders
$router->get(\config::public_root(). 'index.php/renders', RendersController::class, 'index');
$router->get(\config::public_root(). 'index.php/renders/detail', RendersController::class, 'detail');

// Tests
$router->get(\config::public_root(). 'index.php/test1', TestController::class, 'test1');
$router->get(\config::public_root(). 'index.php/test2', TestController::class, 'test2');
$router->get(\config::public_root(). 'index.php/test3', TestController::class, 'test3');

$router->dispatch();