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
        $this->page->data = ['tables' => $context->Pages->fetchAll()];

        $this->page->template = 'templates\tables.php';

        // if called before the fetchAll, will not get anything: problem for later
        $this->page->children['nav'] = $this->getChildren('home', 'nav');

        $view = new View($this->page);

        $view->render();
    }

    public function classLists()
    {
        $this->page->title = 'ClassLists';
        
        $this->page->template = 'templates\tables.php';

        $context = $this->csvContext;
        $this->page->data = ['tables' => $context->ClassLists->fetchAll()];

        $this->page->children['nav'] = $this->getChildren('home', 'nav');

        $view = new View($this->page);

        $view->render();
    }
    
}