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
        
        $this->page->children['nav'] = $this->getChildren('home', 'nav');
        $this->page->children['side'] = $this->getChildren('AFJROTC_Curriculum', 'side');

        $testPage =  (object)array(
            'name'=>'Dashboard',
            'link'=>'dash'
        );

        array_unshift($this->page->children['nav']['data'], $testPage);


        // from here we should be able to hit any other controller strictly using ajax to pull:
        // - views
        // - content

        // each controller should implement an interface that allows it to return these items



    }

    public function index()
    {
        $view = new View($this->page);

        $view->render();
    }

    function childView()
    {
        $childView = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_URL);

        $view = new View($this->page);
        echo json_encode($view->renderChildView($childView));
    }

}


