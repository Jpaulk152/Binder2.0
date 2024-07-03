<?php

namespace Controllers;

use Views\View;
use Views\Layout;
use Views\Page;

use Views\Elements\Element;
use Views\Elements\Button;
use Views\Elements\Table;
use Views\Elements\Form;
use Views\Elements\Card;
use Views\Elements\Gauge;
use Views\Elements\Panel;
use Views\Elements\Navbar;
use Views\Elements\Sidebar;

class DashController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        // echo '<script src="../public/js/debug.js"></script>';
        // echo '<body></body>';

        $table = $this->dbContext->page_table;

        $pages = $table->set(['page_parent'=>'none', 'page_status'=>'true', 'page_inmenu'=>'true'])
                        ->orderBy(['page_title'])
                        ->get(['page_title', 'page_id'])
                        ->with($table, 'children', ['page_parent'=>'page_id'], ['page_title', 'page_id', 'page_parent'], ['page_title'], true)
                        ->toArray();


        $nav = new Navbar(...$pages);
        $sidebar =  new Sidebar(false, ...$pages);

        $sidebar1 = clone $sidebar; $sidebar1->attr('class', 'w3-red');
        $sidebar2 = clone $sidebar; $sidebar2->attr('class', 'w3-blue');
        $sidebar3 = clone $sidebar; $sidebar3->attr('class', 'w3-green');
        $sidebar4 = clone $sidebar; $sidebar4->attr('class', 'w3-orange');
        $sidebar5 = clone $sidebar; $sidebar5->attr('class', 'w3-purple');
        $sidebar6 = clone $sidebar; $sidebar6->attr('class', 'w3-yellow');

        $sidebars = new Panel('sidebars', [$sidebar1, $sidebar2, $sidebar3, $sidebar4]);
        $sidebar->attr('style', 'z-index:1;');

        $element = new Element('div', 'content', ['class'=>'w3-container w3-green', 'style'=>'width:100%;height:100%; overflow:wrap']);
        $card = new Card('card', $element,$element,$element,$element);
        $cards = new Panel('cards', [$card, $card, $card]);

        $gauge1 = new Gauge('gauge1', 65);
        $gauge2 = new Gauge('gauge2', 70);
        $gauge3 = new Gauge('gauge3', 75);
        $gauge4 = new Gauge('gauge4', 80);
        $gauge5 = new Gauge('gauge4', 100);

        $card1 = new Card('AFJROTC Curriculum', $gauge1);
        $card1->addAttributes(['class'=>'w3-container w3-col' , 'style'=>'width:25em; height: 25em; padding: 1em 16px;']);

        $cards = [
            $card1,
            new Card('AFROTC Materials', [new View('this is example')]),
            new Card('AFROTC Materials', [new View('this is an example')]),
        ];

        $gauges = new Panel('gauges', [$gauge1->attr('size', '100'), $gauge2, $gauge3, $gauge4, $gauge5], $cards);
        $gauges->addAttributes(['class'=>'w3-white']);

        $page_table = new Table($this->dbContext->page_table, ['page_parent'=>'none', 'page_status'=>'true', 'page_inmenu'=>'true']);
        $admin_table = new Table($this->dbContext->admin_table);
        $tablePanel = new Panel('tables', [$page_table], [$admin_table]);
        $tablePanel->addAttributes(['class'=>'w3-cell']);

        $sidebar->addAttributes(['class'=>'w3-col primaryBackground']);

        $tables = $this->dbContext->allTables();
        foreach($tables as &$table)
        {
            $table = new Button(name: $table, functions: 'appTable('.$this->toJSON(['table'=>$table]).', `main`)');
        }
        $sidebar = new Sidebar(false, ...$tables);
        $sidebar->addAttributes(['class'=>'w3-col primaryBackground']);

        $main = new Layout($gauges, $sidebars, [$card, $card], [$card, $card, $card], $cards);
        $main->addAttributes(['id'=>'main', 'class'=>'w3-rest', 'style'=>'height:100%;overflow:auto;']);

        $content = new View($sidebar, $main);
        $content->addAttributes(['class'=>'w3-row', 'style'=>'position:relative; height:100%;']);

        $this->page = new Page($nav, $content);
        $this->page->title = 'Examples';
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


        // echo print_r($view, true);

        // $this->page->layout->setView($view);

        $this->index();
    }

}


