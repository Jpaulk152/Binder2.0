<?php

namespace Controllers\Routers;

use Controllers\API\ReadController;
use Controllers\API\HCController;

class APIRouter extends Router
{
    public function __construct()
    {
        $this->post('hc/menu', HCController::class, 'menu');
        $this->post('hc/childMenu', HCController::class, 'childMenu');
        $this->post('hc/pageContent', HCController::class, 'pageContent');

        $this->post('read/table', ReadController::class, 'table');
        $this->post('read/menu', ReadController::class, 'menu');
        $this->post('read/pageContent', ReadController::class, 'pageContent');
    }
}



