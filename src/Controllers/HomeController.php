<?php

namespace Controllers;

use Views\View;

class HomeController extends Controller
{
    // use \ViewModels\Builders\ClassList;

    public function index()
    {
        // $data['template']['page'] = 'templates\index.php';
        // $data['template']['data'] = ['title' => 'index', 'message' => 'Welcome to the Index Page!'];
        // $view = new View($data);
        // $view->render();
    }


    public function home()
    {
        $page = new \stdClass();
        $page->title = 'Home';
        $page->content = 'Test Home';


        $page->children['nav'] = $this->getChildren('home', 'nav');
        $page->children['side'] = $this->getChildren('Faculty_and_Staff_Development', 'side');


        $view = new View($page);

        $view->render();
    }


    function test()
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