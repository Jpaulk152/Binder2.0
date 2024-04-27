<?php

namespace Controllers;

use Views\View;

class TestController extends Controller
{
      
    public function index($test)
    {
        $this->$test();
    }


    function build_admin()
    {
        $response = build_admin();

        echo json_encode($response);
    }


    function test2()
    {
        $page = new \stdClass();
        $page->title = 'Test Title';
        $page->content = 'Test Content';

        $page->template = 'templates\index.php';
        $page->data = ['title' => 'index', 'message' => 'Welcome to the test2 Page!'];

        $view = new View($page);
        $view->render();
    }


    function testHome()
    {
        // create a parent page
        // this page's content goes in mainContent
        $page = new \stdClass();
        $page->title = 'Test Title';
        $page->content = 'Test Content';


        // get children to that parent
            // These child elements go into ViewModels later

        $context = $this->dbContext;
        $context->page_table->set(['page_status' => 'true', 'page_inmenu' => 'false', 'page_parent' => 'none']);
        // $context->page_table->set(['page_id' => 'as100']);

        // ViewModels need by default: an array of element data, an array of classlists to display that data
        $page->children['nav']['data'] = $context->page_table->get()->objects();
        $page->children['side']['data'] = $context->page_table->get()->objects();

        $context = $this->csvContext;
        $context->ClassLists->set(['view'=>'nav']);
        $page->children['nav']['classes'] = $context->ClassLists->exec();

        $context->ClassLists->set(['view'=>'side']);
        $page->children['side']['classes'] = $context->ClassLists->exec();

                
        $view = new View($page);

        $view->render();
    }


    function info()
    {
        phpinfo();
    }
}