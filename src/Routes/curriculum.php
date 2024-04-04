<?php

namespace Routes;

use Controllers\CurriculumController;
use Routes\Router;

$router = new Router();

$router->get('/MVC/public/curriculum.php', CurriculumController::class, 'home');
$router->get('/MVC/public/curriculum.php/home', CurriculumController::class, 'home');

$router->dispatch();