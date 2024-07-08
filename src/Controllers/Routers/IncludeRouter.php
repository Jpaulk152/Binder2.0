<?php

namespace Controllers\Routers;

use Controllers\ResourceController;
use Controllers\Routers\HTTP\Response;

class IncludeRouter extends Router
{
    public function controllerAction() : bool
    {
        $controller = new ResourceController();
        if (!$controller->media($this->uri))
        {
            new Response('resource not found', 404);
        }

        return true;
    }
}