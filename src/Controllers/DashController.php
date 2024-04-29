<?php

namespace Controllers;

use Views\View;

class DashController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();


        // from here we should be able to hit any other controller strictly using ajax to pull:
        // - views
        // - content

        // each controller should implement an interface that allows it to return these items


        $nav1 = [
            // tests
            (object) array ('name'=>'Unit Tests', 'link'=>'javascript:alert(`this is a test...`)', 'children' => 
                [
                    (object)array('name'=>'test whatever', 'link'=>'dash/test'),
                    (object)array('name'=>'getHomeNav', 'link'=>'javascript:getView(`nav`, `navContent`);'),
                    (object)array('name'=>'testPages', 'link'=>'javascript:testReplace(`testPages`, `mainContent`);'),
                    (object)array('name'=>'testDBFields', 'link'=>'javascript:runTest(`testDBFields`);'),
                    (object)array('name'=>'testCSVFields', 'link'=>'javascript:runTest(`testCSVFields`);'),
                    (object)array('name'=>'build_admin', 'link'=>'javascript:runTest(`build_admin`);'),
                ]
            ),

            // jsFunctions
            (object)array('name'=>'JS Tests', 'link'=>'#', 'children' =>
                [
                    (object)array('name'=>'testHomeSide', 'link'=>'javascript:runTest(`testHomeSide`);'),
                    (object)array('name'=>'testHomeNav', 'link'=>'javascript:runTest(`testHomeNav`);'),
                    (object)array('name'=>'Attach Home Side Bar', 'link'=>'javascript:getChildView(`home`, `side`);'),
                    (object)array('name'=>'Detach Side Bar', 'link'=>'javascript:detachChildView(`side`);'),
                ]
            )
        ];


        $this->csvContext->Pages->set(['title'=>'home']);
        $nav2 = $this->csvContext->Pages->get()->fields(['name','link', 'id'])->objects();
        $nav2 = $this->addChildren($nav2, $this->csvContext->Pages);


        $nav  = array_merge($nav1, $nav2);


        $this->page = (object) array('title'=>'Dashboard', 'content'=>'Test Index');        
        $this->page->children['nav']['data'] = $nav;


        $this->page->children['nav']['classes'] = $this->getClasses('nav');

    }


    
    public function index()
    {
        $view = new View($this->page);
        $view->render();
    }


    public function testTemplate()
    {
        $this->index();
    }


    function info()
    {
        phpinfo();
    }

}