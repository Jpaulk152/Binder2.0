<?php

namespace Controllers\API;

use Controllers\Controller;
use Controllers\API\HTTP\Response;
use Controllers\API\HTTP\Request;
use Views\View;
use Views\Defaults\Form;
use Views\Defaults\Table;
use Views\Menus\ProgressView;

class ReadController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();       
    }

    

    public function table($parameters)
    {
        // new Response('<p style="color:red">data not found</p>', 404);
        // new Request($parameters);
        // return;

        extract($parameters);

        // new Response($parameters, 300);
        // return;

        if (isset($entity))
        {
            $objects = $this->read($entity, $filter, $orderBy);

            $table = new Table($entity, $objects);

            new Response($table->create(), 200);
        }
        else
        {
            new Response('<p id="mainContent" style="color:red">data not found</p>', 404);
        }

        
    }


}