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
        $this->get('home', HomeController::class, 'index');

        // Resources
        $this->get('resources/app.css', ResourceController::class, 'stylesheet');
        $this->get('resources/app.js', ResourceController::class, 'jscripts');

        // Examples
        $this->get('examples', ExampleController::class, 'index');

        // Test
        $this->get('test', TestController::class, 'index');

        // Dashboard
        $this->get('dash', DashController::class, 'index');
        $this->get('info', DashController::class, 'info');
    }
}



