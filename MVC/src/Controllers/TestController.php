<?php

namespace Controllers;

use Views\Page;
use Views\View;
use Views\Layout;
use Structures\Tree;


use Views\Elements\Navbar;
use Views\Elements\Sidebar;
use Views\Elements\Button;


use \utilities as u;

class TestController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        echo '<script src="../public/js/debug.js"></script>';
        echo '<body></body>';


        $buttons = [];

        $table = $this->dbContext->page_table;

        $pages = $table->set(

            ['page_parent'=>'afjrotc_css', 'page_status'=>'true', 'page_inmenu'=>'true'], 
            
            function($page)
            {
                return new Button(
                    name: $page['page_title'], 
                    // function1: 'appMenu('.$this->toJSON(['id'=>$page['page_id']]).', `side`)', 
                    function2: 'appPageContent('.$this->toJSON(['id'=>$page['page_id']]).', `main`)',
                );
            }
            
        )
        ->orderBy(['page_title'])
        ->get(['page_title', 'page_id'])
        ->with($table, 'children', ['page_parent'=>'page_id'], ['page_title', 'page_id', 'page_parent'], ['page_title'], true)
        ->toAlternate();
        

        // u::dd($pages);
        // u::dd(count($pages[0]['children']));
        
        // array_walk_recursive($pages, function($value, $key){

        //     u::dd($key . ' : ' . $value, true);

        // });
        


        $nav = new Navbar(...$pages);
        $sidebar =  new Sidebar(false, ...$pages);


        $this->page = new Page($nav, $sidebar->attr('class', 'primaryBackground'));
        $this->page->title = 'Test';


    }

    function index()
    {
        $this->page->render();
    }


    function info()
    {
        phpinfo();
    }
}