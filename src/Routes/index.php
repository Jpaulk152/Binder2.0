<?php

namespace Routes;

use Controllers\HomeController;
use Routes\Router;

$router = new Router();

// echo \config::public_root();

$router->get(\config::public_root(), HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php', HomeController::class, 'index');
$router->get(\config::public_root(). 'index.php/home', HomeController::class, 'home');
$router->get(\config::public_root(). 'index.php/journal', HomeController::class, 'journal');
$router->get(\config::public_root(). 'index.php/menus', HomeController::class, 'menus');

$router->dispatch();