<?php

namespace Controllers;

use Views\View;

class DashController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        $tests = [
            (object)array('name'=>'build_admin', 'link'=>'javascript:runTest(`build_admin`);'),
            (object)array('name'=>'test 2', 'link'=>'javascript:alert(`this is test 2`);'),
            (object)array('name'=>'test 3', 'link'=>'test3')
        ];


        $jsFunctions = [
            (object)array('name'=>'Attach Home Side Bar', 'link'=>'javascript:getChildView(`home`, `side`);'),
            (object)array('name'=>'Detach Side Bar', 'link'=>'javascript:detachChildView(`side`);')
        ];




        $this->page = (object) array('title'=>'Dashboard', 'content'=>'Test Index');        
        $this->page->children['nav']['data'][0] = (object)array(
            'name'=>'Tests',
            'link'=>'javascript:alert(`this is a test...`)',
            'children' => $tests
        );
        $this->page->children['nav']['data'][1] = (object)array(
            'name'=>'JS functions',
            'link'=>'#',
            'children' => $jsFunctions
        );




        $this->csvContext->ClassLists->set(['view'=>'nav']);
        $this->page->children['nav']['classes'] = $this->csvContext->ClassLists->exec();


        // $this->csvContext->ClassLists->set(['view'=>'side']);
        // $this->page->children['side']['classes'] = $this->csvContext->ClassLists->exec();



        // $this->page->children['nav'] = $this->getChildren('home', 'nav');
        // $this->page->children['side'] = $this->getChildren('home', 'side');
    }
    
    public function index($thing)
    {
        $view = new View($this->page);
        $view->render();


        $this->$thing();
    }

    function info()
    {
        phpinfo();
    }

}