<?php

namespace Routes;

use Controllers\HomeController;
use Routes\Router;

$router = new Router();

$router->get('/Binder2.0/public/', HomeController::class, 'index');
$router->get('/Binder2.0/public/index.php', HomeController::class, 'home');
$router->get('/Binder2.0/public/index.php/welcome', HomeController::class, 'welcome');
$router->get('/Binder2.0/public/index.php/journal', HomeController::class, 'journal');

$router->dispatch();