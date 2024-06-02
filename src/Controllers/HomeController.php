<?php

namespace Controllers;

use Views\Layouts\DefaultLayout;
use Views\Page;
use Views\View;
use Views\Containers\Resizer;

use Views\HTMLBuilder;

use Views\Menus\Navbar;
use Views\Menus\Sidebar;

use Views\Defaults\Table;
use Views\Defaults\SubMenuButton;
use Views\Defaults\MenuButton;
use Views\Defaults\ProgressCircle;
use Views\Defaults\Cell;
use Views\Defaults\Row;

use Views\Layout;

use \utilities as u;

class HomeController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        $dashboard =  (object)array(
            'name'=>'Dashboard',
            'link'=>'dash'
        );
        $index = (object)array(
            'name'=>'Index',
            'link'=>'index'
        );
        $materials = (object)array(
            'name'=>'Materials',
            'link'=>'hcMenu({id: `none`}, `side`)',
            'children'=>array(
                (object)array(
                    'name'=>'AFJROTC Curriculum',
                    'link'=>'hcMenu({id: `afjrotc_css`}, `side`)'
                ),
                (object)array(
                    'name'=>'AFROTC Materials',
                    'link'=>'hcMenu({id: `rotc_curriculum`}, `side`)'
                ),
                (object)array(
                    'name'=>'Faculty and Staff Development',
                    'link'=>'hcMenu({id: `faculty_staff_development`}, `side`)'
                )
            )
            // 'link'=>'hcMenu({id: `faculty_staff_development`}, `view2`)'
        );
        
        $nav = array($index, $dashboard, $materials);     

        $objects = $this->dbContext->page_table->set(['page_parent'=>'none', 'page_status'=>'true', 'page_inmenu'=>'true'])->get(['page_title', 'page_id'])->objects();
        // $objects = $this->dbContext->page_table->children($objects, 'page_parent');



        // $object = $this->dbContext->page_table->set(['page_parent'=>'none', 'page_status'=>'true', 'page_inmenu'=>'true'])->get(['page_title', 'page_id'])->firstOrDefault();

        // $object = $objects[0];
        // $cell1 = new View($object->page_id, $object->page_title, ['class'=>'w3-container w3-cell w3-cell-middle']);
        // $progress = new ProgressCircle(34, 50);
        // $cell2 = new View('pc1', $progress->create(), ['class'=>'w3-container w3-cell w3-cell-middle']);
        // $progressExample = new Row([$cell1, $cell2]);

        // $object->page_title = $progressExample->create();
        
        $nav = new Navbar('nav', $nav, ['class'=>'w3-card-4 w3-bar w3-white'], $GLOBALS['style']);

        $side = new Sidebar('side', $objects, [], $GLOBALS['style']);
        $mainView = new View('mainView', 'Test', ['class'=>'w3-container']);

        $main = new Layout('main', [$mainView], []);

        $this->page = new Page([$nav, $side, $main]);

        $this->page->title = 'Home';


    }

    public function index()
    {
        $this->page->render();
    }
    
    function redirect($uri)
    {
        // $msg = '<p style="color:red">No route found for URI: ' . $uri . '</p>';
        // $this->page->setView('view3', $msg);

        $this->index();
    }

}


