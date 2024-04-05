<?php

namespace Routes;

use Controllers\CurriculumController;
use Routes\Router;

$router = new Router();

$router->get('/curriculum.php', CurriculumController::class, 'home');
$router->get('/curriculum.php/home', CurriculumController::class, 'home');

$router->dispatch();