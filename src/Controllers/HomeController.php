<?php

namespace Controllers;

use Views\Layouts\DefaultLayout;
use Views\Page;
use Views\View;
use Views\Containers\Resizer;

use Views\Menus\Navbar;
use Views\Menus\Sidebar;

use Views\Defaults\Table;
use Views\Defaults\Form;
use Views\Defaults\ProgressCircle;

use Views\Layout;

use \utilities as u;

class HomeController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        // $dashboard =  (object)array(
        //     'name'=>'Dashboard',
        //     'link'=>'dash'
        // );
        // $index = (object)array(
        //     'name'=>'Index',
        //     'link'=>'index'
        // );
        // $materials = (object)array(
        //     'name'=>'Materials',
        //     'link'=>'hcMenu({id: `none`}, `side`)',
        //     'children'=>array(
        //         (object)array(
        //             'name'=>'AFJROTC Curriculum',
        //             'link'=>'hcMenu({id: `afjrotc_css`}, `side`)'
        //         ),
        //         (object)array(
        //             'name'=>'AFROTC Materials',
        //             'link'=>'hcMenu({id: `rotc_curriculum`}, `side`)'
        //         ),
        //         (object)array(
        //             'name'=>'Faculty and Staff Development',
        //             'link'=>'hcMenu({id: `faculty_staff_development`}, `side`)'
        //         )
        //     )
        //     // 'link'=>'hcMenu({id: `faculty_staff_development`}, `view2`)'
        // );
        
        // $nav = array($index, $dashboard, $materials);

        echo '<script src="../public/js/debug.js"></script>';
        echo '<body></body>';

        // $objects = $this->dbContext->page_table->set(['page_parent'=>'none', 'page_status'=>'true', 'page_inmenu'=>'true'])->get(['page_title', 'page_id'], function ($page){

        //     $progress = new ProgressCircle(34, 40);
        //     $title = new View('title', $page['page_title'], ['class'=>'w3-container w3-twothird w3-red']);
        //     $progress = new View('ind', $progress->create(), ['class'=>'w3-container w3-third w3-orange']);
        //     $display = new Layout('disp', [$title, $progress], ['class'=>'', 'style'=>'display:flex; align-items:center; width: 100%']);

        //     return [ 'page_title'=>$display->create(), 'page_id'=>$page['page_id'] ];

        // })->objects(function($objects)
        // {
        //     $this->dbContext->page_table->children($objects, 'page_parent');
        // });

        
        // $nav = new Navbar('nav', $nav, ['class'=>'w3-card-4 w3-bar w3-white'], $GLOBALS['style']);

        // $content = $this->dbContext->page_table->set(['page_id'=>'afjrotc_css'])->get(['page_content'])->firstOrDefault()->page_content;


        // $side = new Sidebar('side', $objects, [], '400px');
        // $mainView = new View('mainView', urldecode($content), ['class'=>'w3-container']);

        // $main = new Layout('main', [$mainView], []);

        // $this->page = new Page([$nav, $side, $main]);

        // $this->page->title = 'Home';


        $circ1 = new ProgressCircle(id: 'ind1', progress: 34, size: 150, strokeWidth: 30, speed: 0.3, onclick: '', attributes: ['class'=>'w3-container w3-col', 'style'=>'width:20%']);
        $circ2 = new ProgressCircle(id: 'ind2', progress: 56, size: 180, strokeWidth: 40, speed: 0.5, onclick: '', attributes: ['class'=>'w3-container w3-col', 'style'=>'width:20%']);
        $circ3 = new ProgressCircle(id: 'ind3', progress: 76, size: 200, strokeWidth: 30, speed: 0.6, onclick: '', attributes: ['class'=>'w3-container w3-col', 'style'=>'width:20%']);
        $main = new Layout('main', [$circ1, $circ2, $circ3], ['class'=>'w3-row']);


        // u::dd($main->bundle['css']);

        echo '<style>';
        if (isset($main->bundle['css']))
        {
            foreach($main->bundle['css'] as $css)
            {
                echo $css;
            }
        }
        echo '</style>';

        $this->page = new Page([$main]);



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


