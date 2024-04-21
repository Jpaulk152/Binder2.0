<?php

namespace Controllers;

use Views\View;

class HomeController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function index()
    {
        $data['template']['page'] = 'templates\index.php';
        $data['template']['data'] = ['title' => 'index', 'message' => 'Welcome to the Index Page!'];
        $view = new View($data);
        $view->render();
    }


    public function home()
    {


        $pageSet = $this->dbContext->page_table;
        $pageData = ['view'=>'test'];
        $viewModels[0] = $this->viewData($pageSet, $pageData, 'nav');

        $pageData = ['page_status'=>'true', 'page_inmenu'=>'false', 'page_parent'=>'none'];
        $viewModels[1] = $this->viewData($pageSet, $pageData, 'side');
 

        $this->csvContext->ClassLists->set(['view'=>'home']);
        
        $layout = $this->csvContext->ClassLists->get()->firstOrDefault()->list;

        $data['viewModels'] = $viewModels;
        $data['layout'] = $layout;




        $context = $this->dbContext;
        
        $context->page_table->set(['page_id' => 'as100']);
        // $dbContext->page_table->set(['page_inmenu' => 'false']);

        $pages = $context->page_table->get()->objects();

        // die(urldecode($pages[0]->page_content));

        $content = urldecode($pages[0]->page_content);
        $data['content']['data'] = $content;
                
        $view = new View($data);

        $view->render();
    }
}