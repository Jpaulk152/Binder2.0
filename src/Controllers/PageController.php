<?php

namespace Controllers;

use Views\View;

class PageController extends Controller
{
    
    public function index()
    {
        $page = new \stdClass();

        $page->title = 'Pages';
        $page->template = 'templates\tables.php';

        $context = $this->csvContext;
        $page->data = ['tables' => $context->Pages->fetchAll()];

        
        $page->children['nav'] = $this->getChildren('home', 'nav');
        // $page->children['side'] = $this->getChildren('Faculty_and_Staff_Development', 'side');

        $view = new View($page);

        $view->render();
    }

    public function detail()
    {
        // $data = $this->getData();

        // $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
        // $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_URL);

        // $context = $this->csvContext;
        // $context->ClassLists->set(['id'=>$id, 'title'=>$title]);

        // $pages = $context->ClassLists->fetchAll();

        // // add an html template
        // $data['template']['page'] = 'templates\tables.php';

        // // add data to be displayed in template
        
        // $data['template']['data'] = ['tables' => $pages];

        // $view = new View($data);

        // $view->render();
    }
    
}