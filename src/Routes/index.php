<?php

namespace Routes;

use Controllers\HomeController;
use Routes\Router;

$router = new Router();

$router->get('/MVC/public/', HomeController::class, 'index');
$router->get('/MVC/public/index.php', HomeController::class, 'home');
$router->get('/MVC/public/index.php/welcome', HomeController::class, 'welcome');
$router->get('/MVC/public/index.php/journal', HomeController::class, 'journal');

$router->dispatch();