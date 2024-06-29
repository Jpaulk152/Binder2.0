<?php

namespace Controllers;

use Views\Page;
use Views\Layout;
use Views\View;
use Views\Elements\Element;
use Views\Elements\Panel;
use Views\Elements\Navbar;
use Views\Elements\Sidebar;
use Views\Elements\Card;
use Views\Elements\Gauge;
use Views\Elements\Button2;
use Views\Elements\Dropdown;
use Views\Elements\Expander;
use Views\Elements\Image;
use Views\Elements\Form;
use Views\Elements\Table;

class HomeController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        echo '<script src="public/js/debug.js"></script>';
        echo '<body></body>';

        $dashboard = new Element('a', 'Dashboard', ['href'=>'dash', 'class'=>'w3-button']);

        $index = new Element('a', 'Index', ['href'=>'index', 'class'=>'w3-button']);
        $examples = new Element('a', 'Examples', ['href'=>'examples', 'class'=>'w3-button']);


        $page = $this->dbContext->page_table->get(['page_title', 'page_id'])->firstOrDefault();

        $button2 = new Button2($page['page_title'], "alert", $page);

        $nav = new Navbar($index, $dashboard, $examples, $button2);

        $image = new Image('../public/resources/BioCantwell.JPG');
        $div = new Element('div', '<p>thiasawrgarg a bunch of tddddddddddddddddddddddddddddextasgl;awugha;rauhr;gaorgah;rgo<br><br>awrelguiahwrglaiughalweirhelguiah</p>');
        $bio = new Panel('Welcome to the .....', [$image, $div]);


        $this->page = new Page($nav, $bio);
    }

    public function index()
    {
        $this->page->render();
    }
    
    function redirect($uri)
    {
        // $msg = '<p style="color:red">No route found for URI: ' . $uri . '</p>';
        // $this->page->layout->setView(new View('main', $msg));

        // $this->index();
    }

    function insert($parameters)
    {
        extract($parameters);

        // new Response($parameters, 300);
        // return;

        // $view = new View($id, $entity);
        // $view->bundle = $bundle;


        // echo print_r($view, true);

        // $this->page->layout->setView($view);

        // $this->index();
    }

}


