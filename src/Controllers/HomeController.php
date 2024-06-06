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
use Views\Defaults\Card;
use Views\Defaults\Gauge;

use Controllers\API\HTTP\Response;

use Views\Layout;

use \utilities as u;
use Views\Defaults\Image;
use Views\Includes\Includes;

class HomeController extends Controller
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
        $examples = (object)array(
            'name'=>'Examples',
            'link'=>'example'
        );
        
        $objects = [$index, $dashboard, $materials, $examples];
        $nav = new Navbar('nav', $objects, ['class'=>'w3-card-4 w3-bar w3-white']);

        $circ2 = new Gauge(id: 'ind2', progress: 14, attributes: [], onclick: '', size: 50);
        $circ3 = new Gauge(id: 'ind3', progress: 76, attributes: [], onclick: '', size: 60);
        $circ4 = new Gauge(id: 'ind4', progress: 13, attributes: [], onclick: '', size: 70);
        $circ5 = new Gauge(id: 'ind5', progress: 34, attributes: [], onclick: '', size: 80);

        $cardStyle = ['class'=>'w3-container w3-col' , 'style'=>'width:25em; height: 25em; padding: 1em 16px;'];
        $layoutStyle = ['class'=>'w3-row panel', 'style'=>'padding: 64px;'];

        $cards = [
            new Card('card1', 'AFJROTC Curriculum', [$circ4],  $cardStyle),
            new Card('card2', 'AFROTC Materials', [new View('someText', 'this is home')], $cardStyle),
            new Card('card3', 'card3', [$circ2], $cardStyle),
            new Card('card4', 'card4', [$circ3], $cardStyle),
            new Card('card5', 'card5', [$circ5], $cardStyle)
        ];

        $cards = new Layout ('cards', $cards, $layoutStyle);
        $main = new Layout ('main', [$cards], ['class'=>'w3-row']);

        $this->page = new Page([$nav, $main]);
    }

    public function index()
    {
        $this->page->render();
    }
    
    function redirect($uri)
    {
        $msg = '<p style="color:red">No route found for URI: ' . $uri . '</p>';
        $this->page->layout->setView(new View('main', $msg));

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


