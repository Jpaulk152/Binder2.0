<?php

namespace Controllers;

use Controllers\API\Request;
use Controllers\API\Response;
use Views\View;
use Views\Templates\Template;

class APIController extends Controller
{
    
    public $page;

    public function __construct()
    {
        parent::__construct();

        // $this->page = (object) array('title'=>'Tables');

        // $context = $this->csvContext;
        // $context->Pages->set(['title'=>'home']);
        // $nav = $context->Pages->get()->fields(['name','link', 'id'])->objects();
        // $nav = $this->addChildren($nav, $context->Pages);

        // $this->page->children['nav']['data'] = $nav;
        // $this->page->children['nav']['classes'] = $this->getClasses('nav');
       
    }

    public function index($uri)
    {
        $this->$uri();
    }


    public function get($uri='')
    {
        if(empty($uri))
        {
            new Response('', 404);
        }

        $context = $this->dbContext;
        $data = ['objects' => [$uri => $context->$uri->fetchAll()]];

        $template = new Template('objects.php', $data);
        $page = (object) array('template' => $template);
        
        $view = new View($page);

        new Response($view->renderTemplate(), 200, ['Content-Type: application/json']);
    }  
}