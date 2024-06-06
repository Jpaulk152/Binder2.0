<?php

namespace Controllers;

use Views\Layouts\DefaultLayout;
use Views\Page;
use Views\View;

use Views\Menus\Navbar;
use Views\Menus\Sidebar;

use Views\Defaults\Card;
use Views\Defaults\Gauge;


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


        // $circ1 = new ProgressCircle(id: 'ind1', progress: 100, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%']);
        // $circ2 = new ProgressCircle(id: 'ind2', progress: 14, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%'], onclick: '', size: 50);
        // $circ3 = new ProgressCircle(id: 'ind3', progress: 76, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%'], onclick: '', size: 60);
        // $circ4 = new ProgressCircle(id: 'ind4', progress: 13, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%'], onclick: '', size: 70);
        // $circ5 = new ProgressCircle(id: 'ind5', progress: 34, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%'], onclick: '', size: 80);
        // $circ6 = new ProgressCircle(id: 'ind6', progress: 34, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%'], onclick: '', size: 90);
        // $circ7 = new ProgressCircle(id: 'ind7', progress: 56, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%'], onclick: '', size: 100);
        // $circ8 = new ProgressCircle(id: 'ind8', progress: 76, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%'], onclick: '', size: 130);
        // $circ9 = new ProgressCircle(id: 'ind9', progress: 13, attributes: ['class'=>'w3-container w3-col', 'style'=>'width:10%']);

        // $main = new Layout('main', [$circ1, $circ2, $circ3, $circ4, $circ5,$circ6, $circ7, $circ8, $circ9, $circ1], ['class'=>'w3-center w3-row']);

        // $main = new Layout('main', [$circ1], ['class'=>'w3-center w3-row']);

        $circ2 = new Gauge(id: 'ind2', progress: 14, attributes: [], onclick: '', size: 50);
        $circ3 = new Gauge(id: 'ind3', progress: 76, attributes: [], onclick: '', size: 60);
        $circ4 = new Gauge(id: 'ind4', progress: 13, attributes: [], onclick: '', size: 70);
        $circ5 = new Gauge(id: 'ind5', progress: 34, attributes: [], onclick: '', size: 80);

        $objects = $this->dbContext->page_table->set(['page_parent'=>'none'])->get(['page_title', 'page_id'])->objects();
        $testMenu = new Sidebar('testMenu', $objects, ['style'=>'height: 100%;']);

        // ob_start();
        // include('src/Views/Defaults/Card.php');

        $cardStyle = ['class'=>'w3-container w3-col' , 'style'=>'width:25em; height: 25em; padding: 1em 16px;'];
        $layoutStyle = ['class'=>'w3-row panel', 'style'=>'padding: 64px;'];

        // $card = ob_get_clean();

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
            // new Card('card6', 'card6', [$testMenu], $cardStyle)
        ];


        $sidebars = [$testMenu];



        // $card1 = new View('card1', $card, ['class'=>'w3-container w3-col' , 'style'=>'width:30%']);
        // $card2 = new View('card2', $card, ['class'=>'w3-container w3-col' , 'style'=>'width:30%']);
        $cards = new Layout ('cards', $cards, $layoutStyle);
        $sidebars = new Layout ('sidebars', $sidebars, $layoutStyle);
        $main = new Layout ('main', [$cards, $sidebars], ['class'=>'w3-row']);
        $this->page = new Page(views: [$nav, $main], attributes: [], docType: 'html', lang: 'en', title: 'Examples', meta: ['charset="UTF-8"'], bundle: []);


        // $this->page = new Page([$main]);



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


