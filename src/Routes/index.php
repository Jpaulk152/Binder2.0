<?php

namespace Routes;

use Controllers\HomeController;
use Controllers\CurriculumController;
use Controllers\MenuController;
use Controllers\ContentController;
use Controllers\TestController;

use Models\DB\CSVContext;

use Routes\Router;

global $_csvContext;

$_csvContext = new CSVContext();
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


// Content
$router->get(\config::public_root(). 'index.php/content', ContentController::class, 'content');

$router->get(\config::public_root(). 'index.php/test1', TestController::class, 'test1');
$router->get(\config::public_root(). 'index.php/test2', TestController::class, 'test2');
$router->get(\config::public_root(). 'index.php/test3', TestController::class, 'test3');
$router->get(\config::public_root(). 'index.php/pages', TestController::class, 'pages');
$router->get(\config::public_root(). 'index.php/content', TestController::class, 'content');

$router->dispatch();