<?php

namespace Routes;

use Controllers\HomeController;
use Routes\Router;

$router = new Router();


$router->get('/', HomeController::class, 'home');
$router->get('/index.php', HomeController::class, 'home');
$router->get('/index.php/home', HomeController::class, 'home');
$router->get('/index.php/journal', HomeController::class, 'journal');

$router->dispatch();