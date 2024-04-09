<?php

namespace Routes;

use Controllers\HomeController;
use Controllers\CurriculumController;
use Controllers\MenuController;
use Routes\Router;

$router = new Router();

// echo \config::public_root();

$router->get(\config::public_root(), HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php', HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php/home', HomeController::class, 'home');
$router->get(\config::public_root(). 'index.php/journal', HomeController::class, 'journal');

$router->get(\config::public_root(). 'index.php/curriculum', CurriculumController::class, 'home');
$router->get(\config::public_root(). 'index.php/curriculum/home', CurriculumController::class, 'home');

$router->get(\config::public_root(). 'index.php/menus', MenuController::class, 'menus');
$router->get(\config::public_root(). 'index.php/allMenus', MenuController::class, 'allMenus');

$router->dispatch();