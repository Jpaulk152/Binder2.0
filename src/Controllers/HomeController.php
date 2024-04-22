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
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_URL);

        $page = new \stdClass();

        $page->content = ''; //$content;
        $page->view = 'home';


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
        
        $context->page_table->set(['page_id' => $page]);
        // $dbContext->page_table->set(['page_inmenu' => 'false']);

        $pages = $context->page_table->get()->objects();

        // die(urldecode($pages[0]->page_content));

        if($pages)
        {
            $content = urldecode($pages[0]->page_content);
        }
        else
        {
            $content = 'no page found';
        }
        
        $data['content']['data'] = $content;





                
        // $view = new View($data);
        $view = new View($page);

        $view->render();
    }
}

// test_page_3
// test_page_2
// test4
// softwaremain
// software main
// sd
// rotc
// reporting_test
// pdfrender_test
// ots
// main
// long_test
// jrotc_dev
// jrotc
// jr_form_test
// jr1
// instructions
// downloadsoftware
// dib1234
// dib123
// detlocater
// cap-usaf
// camtasia_test
// calt
// as400
// as300
// as200b
// as200
// as100b2
// as100b
// as100
// afrotc_career_day
// ac2_test
// a_test