<?php

namespace Controllers;

use Views\View;
use Views\Template;

class HomeController extends Controller
{
    public $page;

    public $nav = [
        'parameters'=> ['page_status' => 'true', 'page_inmenu' => 'false', 'page_parent' => 'none'], 
        'fields' => ['page_title', 'page_id'],
        'primaryKey' => 'page_id',
        'foreignKey' => 'page_parent',
        'classes' => 'nav'
    ];

    public $side = [
        'parameters'=> ['page_status' => 'true', 'page_inmenu' => 'false', 'page_parent' => 'none'],
        'fields' => ['page_title', 'page_id'],
        'primaryKey' => 'page_id', 
        'foreignKey' => 'page_parent',
        'classes' => 'side' // handle when we don't get any classlist
    ];


    public function __construct()
    {
        parent::__construct();

        $this->page = new \stdClass();
        $this->page->title = 'Home';
        $this->page->content = 'Home Index';

        $this->page->children['nav'] = $this->addView($this->nav, $this->dbContext->page_table);
        $this->page->children['side'] = $this->addView($this->side, $this->dbContext->page_table);

        $dashboard =  (object)array(
            'name'=>'Dashboard',
            'link'=>'dash'
        );

        array_unshift($this->page->children['nav']['data'], $dashboard);

        $index = (object)array(
            'name'=>'Index',
            'link'=>'index'
        );

        array_unshift($this->page->children['nav']['data'], $index);
    }

    public function index($uri=false)
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


