<?php

namespace Controllers;

use Controllers\API\Request;
use Views\View;
use Views\Templates\Template;
use Controllers\API\Response;

class TableController extends Controller
{
    
    public $page;

    public function __construct()
    {
        parent::__construct();

        // $this->page = (object) array('title'=>'Tables');

        // $context = $this->csvContext;
        // $context->Pages->set(['title'=>'home']);
        // $nav = $context->Pages->get()->fields(['name','link', 'id'])->objects();
        // $nav = $this->addChildren($nav, $context->Pages);

        // $this->page->children['nav']['data'] = $nav;
        // $this->page->children['nav']['classes'] = $this->getClasses('nav');
       
    }

    public function index($uri)
    {
        $this->$uri();
    }


    public function pages()
    {
        $context = $this->csvContext;
        $data = ['tables' => $context->Page->fetchAll()];

        $template = new Template('tables.php', $data);
        $page = (object) array('template' => $template);
        
        $view = new View($page);

        new Response($view->renderTemplate(), 200, ['Content-Type: application/json']);

        // echo json_encode($view->renderTemplate());
    }


    public function classLists()
    {
        $context = $this->csvContext;
        $data = ['tables' => $context->ClassList->fetchAll()];

        $template = new Template('tables.php', $data);
        $page = (object) array('template' => $template);
        
        $view = new View($page);

        echo json_encode($view->renderTemplate());
    }    


        public function get($uri='')
    {
        if(empty($uri))
        {
            new Response('', 404);
        }

        $context = $this->dbContext;
        $data = ['tables' => $context->$uri->fetchAll()];

        $template = new Template('tables.php', $data);
        $page = (object) array('template' => $template);
        
        $view = new View($page);

        new Response($view->renderTemplate(), 200, ['Content-Type: application/json']);

        // echo json_encode($view->renderTemplate());
    }  
}