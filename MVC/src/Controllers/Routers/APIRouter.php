<?php

namespace Controllers\Routers;

use Controllers\API\ReadController;
use Controllers\API\HCController;

class APIRouter extends Router
{
    public function __construct()
    {
        $this->post(\config::app_root() . 'api/hc/menu', HCController::class, 'menu');
        $this->post(\config::app_root() . 'api/hc/childMenu', HCController::class, 'childMenu');
        $this->post(\config::app_root() . 'api/hc/pageContent', HCController::class, 'pageContent');

        $this->post(\config::app_root() . 'app/read/table', ReadController::class, 'table');
        $this->post(\config::app_root() . 'app/read/menu', ReadController::class, 'menu');
        $this->post(\config::app_root() . 'app/read/pageContent', ReadController::class, 'pageContent');
    }
}



