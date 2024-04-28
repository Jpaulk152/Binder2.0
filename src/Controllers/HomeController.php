<?php

namespace Controllers;

use Views\View;

class HomeController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        $this->page = new \stdClass();
        $this->page->title = 'Home';
        $this->page->content = 'Home Index';
        
        // $this->page->children['nav'] = $this->getChildren('home', 'nav');
        // $this->page->children['side'] = $this->getChildren('AFJROTC_Curriculum', 'side');

        $context = $this->dbContext;
        $context->page_table->set(['page_status' => 'true', 'page_inmenu' => 'false', 'page_parent' => 'none']);
        // $context->page_table->set(['page_id' => 'as200']);


        $nav = $context->page_table->get()->fields(['page_title', 'page_id'])->objects();
        $nav = $this->addChildren($nav, $context->page_table, 'page_id', 'page_parent', ['page_title', 'page_id']);
        $side = $nav;


        $this->page->children['nav']['data'] = $nav;
        $this->page->children['side']['data'] = $side;

        // nav menu classlists
        $this->page->children['nav']['classes'] = $this->getClasses('nav');
        $this->page->children['side']['classes'] = $this->getClasses('side');


        $dashboard =  (object)array(
            'name'=>'Dashboard',
            'link'=>'dash'
        );

        array_unshift($this->page->children['nav']['data'], $dashboard);
    }

    public function index()
    {
        $view = new View($this->page);

        $view->render();
    }

    function redirect($uri)
    {
        $this->page->content = '<p style="color:red">No route found for URI: ' . $uri . '</p>';
        $this->index();
    }

    function childView()
    {
        $childView = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_URL);

        $view = new View($this->page);
        echo json_encode($view->renderChildView($childView));
    }
}


