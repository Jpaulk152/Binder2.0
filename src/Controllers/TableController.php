<?php

namespace Controllers;

use Views\View;

class TableController extends Controller
{
    
    public $page;

    public function __construct()
    {
        parent::__construct();

        $this->page = (object) array('title'=>'Tables');

       
    }

    public function index()
    {

    }

    public function pages()
    {
        $this->page->title = 'Pages';


        $context = $this->csvContext;

        // if called after add children, does not pull data
        $this->page->data = ['tables' => $context->Pages->fetchAll()];
        $this->page->template = 'templates\tables.php';


        $context->Pages->set(['title'=>'home']);
        $nav = $context->Pages->get()->fields(['name','link', 'id'])->objects();
        $nav = $this->addChildren($nav, $context->Pages);

        $this->page->children['nav']['data'] = $nav;
        $this->page->children['nav']['classes'] = $this->getClasses('nav');
        

        $view = new View($this->page);

        $view->render();
    }

    public function classLists()
    {
        $this->page->title = 'ClassLists';
        
        $context = $this->csvContext;

        // if called after add children, does not pull data
        $this->page->data = ['tables' => $context->ClassLists->fetchAll()];
        $this->page->template = 'templates\tables.php';

        $context->Pages->set(['title'=>'home']);
        $nav = $context->Pages->get()->fields(['name','link', 'id'])->objects();
        $nav = $this->addChildren($nav, $context->Pages);

        $this->page->children['nav']['data'] = $nav;
        $this->page->children['nav']['classes'] = $this->getClasses('nav');
        

        $view = new View($this->page);

        $view->render();
    }
    
}