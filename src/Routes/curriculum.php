<?php

namespace Routes;

use Controllers\CurriculumController;
use Routes\Router;

$router = new Router();

$router->get(\config::public_root() . '/curriculum.php', CurriculumController::class, 'home');
$router->get(\config::public_root() . 'curriculum.php/home', CurriculumController::class, 'home');

$router->dispatch();