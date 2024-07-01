<?php

namespace Controllers\API;

use Controllers\Controller;
use Controllers\API\HTTP\Response;
use Controllers\API\HTTP\Request;
use Views\View;
use Views\Elements\Form;
use Views\Elements\Table;

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

        // new Response($table, 300);
        // return;

        if (isset($table))
        {

            $table = new Table($this->dbContext->$table);

            new Response($table->create(), 200);
        }
        else
        {
            new Response('<p id="main" style="color:red">data not found</p>', 404);
        }
    }


}