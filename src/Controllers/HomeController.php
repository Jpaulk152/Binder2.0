<?php

namespace Controllers;

use Views\Layouts\DefaultLayout;
use Views\Page;
use Views\View;
use \utilities as u;

class HomeController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        $navItems = $this->dbContext->page_table->set(['page_status'=>'true', 'page_inmenu'=>'true', 'page_parent'=>'none'])->get(['page_title', 'page_id'])->objects();

        $dashboard =  (object)array(
            'name'=>'Dashboard',
            'link'=>'dash'
        );
        array_unshift($navItems, $dashboard);
        $index = (object)array(
            'name'=>'Index',
            'link'=>'index'
        );
        array_unshift($navItems, $index);
        $sideItems = array_values($navItems);

        $nav = new View('Navbars/HCDefault.php', [$navItems]);
        $side = new View('Sidebars/HCDefault.php', [$sideItems]);
        $main = 'Home Index';

        $layout = new DefaultLayout($nav, $side, $main);

        $this->page = new Page();

        $this->page->setLayout($layout);

        $this->page->title = 'Home';
    }

    public function index()
    {
        $this->page->render();
    }


    
    function redirect($uri)
    {
        $msg = '<p style="color:red">No route found for URI: ' . $uri . '</p>';
        $this->page->layout->setView('main', $msg);

        $this->index();
    }
}


