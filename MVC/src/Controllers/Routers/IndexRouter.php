<?php

namespace Controllers\Routers;

use Controllers\IndexController;
use Controllers\HomeController;
use Controllers\ResourceController;
use Controllers\TestController;
use Controllers\DashController;
use Controllers\ExampleController;
use Controllers\API\ReadController;
use Controllers\API\HCController;

class IndexRouter extends Router
{
    public function __construct()
    {
        parent::__construct(IndexController::class, 'redirect');

        // Home
        $this->get(\config::app_root() . 'home', HomeController::class, 'index');

        // Resources
        $this->get(\config::app_root() . 'resources/app.css', ResourceController::class, 'stylesheet');
        $this->get(\config::app_root() . 'resources/app.js', ResourceController::class, 'jscripts');

        // Examples
        $this->get(\config::app_root() . 'examples', ExampleController::class, 'index');

        // Test
        $this->get(\config::app_root() . 'test', TestController::class, 'index');

        // Dashboard
        $this->get(\config::app_root() . 'dash', DashController::class, 'index');
        $this->get(\config::app_root() . 'info', DashController::class, 'info');
    }
}



