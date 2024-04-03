<?php

namespace Routes;

use Controllers\HomeController;
use Controllers\CurriculumController;
use Routes\Router;

$router = new Router();

$router->get('/public/', HomeController::class, 'index');
$router->get('/public/index.php', HomeController::class, 'home');
$router->get('/public/index.php/welcome', HomeController::class, 'welcome');
$router->get('/public/index.php/journal', HomeController::class, 'journal');

$router->get('/public/index.php/curriculum', CurriculumController::class, 'home');
$router->get('/public/index.php/curriculum/home', CurriculumController::class, 'home');

$router->dispatch();