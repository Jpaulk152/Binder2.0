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
        // $context->page_table->set(['page_id' => 'as100']);

        $this->page->children['nav']['data'] = $context->page_table->get()->fields(['page_title', 'page_id'])->objects();
        $this->page->children['side']['data'] = $context->page_table->get()->fields(['page_title', 'page_id'])->objects();


        // nav menu classlists
        $context = $this->csvContext;
        $context->ClassLists->set(['view'=>'nav']);
        $this->page->children['nav']['classes'] = $context->ClassLists->exec();

        $context->ClassLists->set(['view'=>'side']);
        $this->page->children['side']['classes'] = $context->ClassLists->exec();


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


