<?php

namespace Routes;

use Controllers\HomeController;
use Routes\Router;

$router = new Router();

echo \config::public_root();

$router->get(\config::public_root().'/', HomeController::class, 'index');
$router->get(\config::public_root() . '/index.php', HomeController::class, 'home');
$router->get(\config::public_root() . '/index.php/welcome', HomeController::class, 'welcome');
$router->get(\config::public_root() . '/index.php/journal', HomeController::class, 'journal');

$router->dispatch();