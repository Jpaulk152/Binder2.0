<?php

namespace Controllers;

use Views\View;
use Views\Templates\Template;

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

        echo json_encode($view->renderTemplate());
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
}