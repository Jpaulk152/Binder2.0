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

        $this->page = (object) array('title'=>'Tables');

        $context = $this->csvContext;
        $context->Pages->set(['title'=>'home']);
        $nav = $context->Pages->get()->fields(['name','link', 'id'])->objects();
        $nav = $this->addChildren($nav, $context->Pages);

        $this->page->children['nav']['data'] = $nav;
        $this->page->children['nav']['classes'] = $this->getClasses('nav');
       
    }

    public function index()
    {

    }

    public function pages()
    {
        $this->page->title = 'Pages';

        $context = $this->csvContext;
        $data = ['tables' => $context->Pages->fetchAll()];

        $template = new Template('tables.php', $data);
        $this->page->template = $template;
        
        $view = new View($this->page);

        $view->render();
    }

    public function classLists()
    {
        $this->page->title = 'ClassLists';
        
        $context = $this->csvContext;
        $data = ['tables' => $context->ClassLists->fetchAll()];

        $template = new Template('tables.php', $data);
        $this->page->template = $template;   

        $view = new View($this->page);

        $view->render();
    }
    
}