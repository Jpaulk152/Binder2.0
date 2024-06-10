<?php

namespace Controllers;

use Views\Layouts\DefaultLayout;
use Views\Page;
use Views\View;

use Views\Menus\Navbar;
use Views\Menus\Sidebar;
use Views\Menus\Sidebar2;

use Views\Defaults\Card;
use Views\Defaults\Gauge;

use Views\Buttons\MenuButton;


use Views\Layout;

use \utilities as u;
use Views\Defaults\Image;
use Views\Includes\Includes;

class ExampleController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        // echo '<script src="public/js/debug.js"></script>';
        // echo '<body></body>';

        $params = [
            'id' => 'none',
            'view' => Sidebar::class,
        ];

        $params = $this->toJSON($params);

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
            'link'=>'hcMenu('.$this->toJSON(['id' => 'none','view' => Sidebar::class]).', `side`)',
            'children'=>array(
                (object)array(
                    'name'=>'AFJROTC Curriculum',
                    'link'=>'hcMenu('.$this->toJSON(['id' => 'afjrotc_css','view' => Sidebar::class]).', `side`)'
                ),
                (object)array(
                    'name'=>'AFROTC Materials',
                    'link'=>'hcMenu('.$this->toJSON(['id' => 'rotc_curriculum','view' => Sidebar::class]).', `side`)'
                ),
                (object)array(
                    'name'=>'Faculty and Staff Development',
                    'link'=>'hcMenu('.$this->toJSON(['id' => 'faculty_staff_development','view' => Sidebar::class]).', `side`)'
                )
            )
        );
        
        $objects = [$materials];
        $nav = new Navbar('nav', $objects, ['class'=>'w3-card-4 w3-bar w3-white']);


        $circ2 = new Gauge(id: 'ind2', progress: 14, attributes: [], onclick: '', size: 50);
        $circ3 = new Gauge(id: 'ind3', progress: 76, attributes: [], onclick: '', size: 60);
        $circ4 = new Gauge(id: 'ind4', progress: 13, attributes: [], onclick: '', size: 70);
        $circ5 = new Gauge(id: 'ind5', progress: 34, attributes: [], onclick: '', size: 80);

        $objects = $this->dbContext->page_table->set(['page_parent'=>'none'])->get(['page_title', 'page_id'])->objects();


        $function = 'hcPageContent';

        foreach($objects as &$object)
        {

            $params = ['id'=>$object->page_id];
            $link = $function . '('.$this->toJSON($params).', `main`)';

            $object = new View($object->page_id, $object->page_title, ['class'=>'menubutton w3-bar-item w3-button', 'onclick'=>$link]);
        }

        $testMenu = new Sidebar2('testMenu', $objects, ['style'=>'position: fixed; z-index: 1; border: 5px solid green']);

        $cardStyle = ['class'=>'w3-container w3-col' , 'style'=>'width:25em; height: 25em; padding: 1em 16px; border: solid 5px orange;'];
        $layoutStyle = ['class'=>'layout w3-row panel', 'style'=>'padding: 64px; border: solid 5px blue;'];

        // $path = Includes::path('logo');
        // $path = '../public/resources/pic1.jpg';
        // $image1 = new Image('image1', $path);
        // $path = '../public/resources/pic2.jpg';
        // $image2 = new Image('image2', $path);

        $cards = [
            new Card('card1', 'AFJROTC Curriculum', [$circ4],  $cardStyle),
            new Card('card2', 'AFROTC Materials', [new View('someText', 'this is example')], $cardStyle),
            new Card('card3', 'card3', [$circ2], $cardStyle),
            new Card('card4', 'card4', [$circ3], $cardStyle),
            new Card('card5', 'card5', [$circ5], $cardStyle),
        ];


        $sidebars = [

            new Sidebar2('testMenu1', $objects, ['class'=>'w3-row w3-half', 'style'=>'position: relative; z-index: 1; overflow: hidden; border: 5px solid red']),
            new Sidebar2('testMenu2', $objects, ['class'=>'w3-row w3-half', 'style'=>'position: relative; z-index: 1; overflow: hidden; border: 5px solid green'])

        ];



        // $card1 = new View('card1', $card, ['class'=>'w3-container w3-col' , 'style'=>'width:30%']);
        // $card2 = new View('card2', $card, ['class'=>'w3-container w3-col' , 'style'=>'width:30%']);
        $cards = new Layout ('cards', $cards, $layoutStyle);
        $sidebars = new Layout ('sidebars', $sidebars, $layoutStyle);
        $main = new Layout ('main', [$cards, $sidebars], ['class'=>'']);
        $this->page = new Page(views: [$nav, $testMenu, $main], attributes: [], docType: 'html', lang: 'en', title: 'Examples', meta: ['charset="UTF-8"'], bundle: []);

    }


    public function addView($object)
    {

        $progress = new Gauge(
            id: $object['page_id'].'-ind', 
            progress: strlen($object['page_title'])*2, 
            attributes: ['class'=>'w3-container w3-third'], 
            onclick: '', 
            size: 50, 
            strokeWidth: 30
        );

        $title = new View(
            id: 'title', 
            entity: $object['page_title'], 
            attributes: ['class'=>'w3-container w3-twothird']
        );

        $display = new Layout(
            id: 'disp', 
            views: [$title, $progress], 
            attributes: ['style'=>'display:flex; align-items:center; width: 100%']
        );

        return [ 'page_title'=>$display, 'page_id'=>$object['page_id'] ];
    }


    public function addLinks(array $objects)
    {
        foreach($objects as $object)
        {
            $function = 'hcPageContent';
            $target = 'main';

            $params = ['id'=>$object->page_id];
            $link = $function . '('.$this->toJSON($params).', `'.$target.'`)';

            $object->page_id = $link;

            if (property_exists($object, 'children'))
            {
                $this->addLinks($object->children);
            }
        }
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

    function insert($parameters)
    {
        extract($parameters);

        // new Response($parameters, 300);
        // return;

        $view = new View($id, $entity);
        $view->bundle = $bundle;


        // echo print_r($view, true);

        $this->page->layout->setView($view);

        $this->index();
    }

}


