<?php

namespace Controllers;

use Views\View;
use Views\Templates\Template;

class TestController extends Controller
{
      
    public function index($test)
    {
        $this->$test();
    }


    function testPages()
    {
        $context = $this->csvContext;
        $data = ['tables' => $context->Pages->fetchAll()];

        $template = new Template('tables.php', $data);
        $page = (object) array('template' => $template);
        
        $view = new View($page);

        echo json_encode($view->renderTemplate());
    }


    function testDBFields()
    {
        $this->dbContext->page_table->set(['page_id' => 'as100']);
        $page = $this->dbContext->page_table->get()->fields(['page_id', 'page_title'])->firstOrDefault();//FIX THIS: can't remember, I think this is fixed

        echo json_encode($page->page_title);
    }

    function testCSVFields()
    {
        $this->csvContext->Page->set(['id' => 3]);
        $page = $this->csvContext->Page->get()->fields(['id', 'name'])->firstOrDefault();

        echo json_encode($page->name);
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

        $page->template = 'Templates\index.php';
        $page->data = ['title' => 'index', 'message' => 'Welcome to the test2 Page!'];

        $view = new View($page);
        $view->render();
    }


    function testHomeSide()
    {
        $page = new \stdClass();

        // side menu data
        $context = $this->dbContext;
        $context->page_table->set(['page_status' => 'true', 'page_inmenu' => 'false', 'page_parent' => 'none']);
        // $context->page_table->set(['page_id' => 'as100']);
        $page->children['side']['data'] = $context->page_table->get()->objects();

        // side menu classlists
        $context = $this->csvContext;
        // $context->ClassLists->set(['view'=>'side2']);
        $page->children['side']['classes'] = $context->ClassList->exec();

        $view = new View($page);
        echo json_encode($view->renderChildView('side'));
    }



    function testHomeNav()
    {
        $page = new \stdClass();

        $context = $this->dbContext;
        $context->page_table->set(['page_status' => 'true', 'page_inmenu' => 'false', 'page_parent' => 'none']);
        // $context->page_table->set(['page_id' => 'as100']);
        $page->children['nav']['data'] = $context->page_table->get()->objects();

        $context = $this->csvContext;
        $context->ClassLists->set(['view'=>'nav']);
        $page->children['nav']['classes'] = $context->ClassLists->exec();
                
        $view = new View($page);
        echo json_encode($view->renderChildView('nav'));
    }


    function error($msg)
    {
        echo json_encode(['error'=> $msg]);
    }


    function info()
    {
        phpinfo();
    }
}