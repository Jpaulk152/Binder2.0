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


    public function getTable($parameters)
    {
        if(!$parameters || !isset($parameters['table']))
        {
            new Response('404 error', 404);
        }

        $table = $parameters['table'];

        $context = $this->dbContext;
        $data = [$table => $context->$table->fetchAll()];

        $template = new Template('table.php', $data);
        $page = (object) array('template' => $template);
        
        $view = new View($page);

        new Response($view->renderTemplate(), 200, ['Content-Type: application/json']);
        // new Response($parameters['table'], 200, ['Content-Type: application/json']);
    }


    public function form($parameters)
    {
        // $data = ['thing'=>['dataToExtract']];

        // $template = new Template('form.php', $data);
        // $page = (object) array('template' => $template);
        
        // $view = new View($page);
        // new Response($view, 200, ['Content-Type: application/json']);



        if($parameters)
        {
            extract($parameters);



            $object = $parameters['object'];
            $id = $parameters['id'];

            $pk = $this->dbContext->$object->getPrimaryKey();

            $data = $this->dbContext->page->set([$pk=>$id])->get()->firstOrDefault();


            new Response($id, 404);
        }
        else
        {
            new Response('', 404);
        }
    }


    public function create()
    {
        new Response('works', 200, ['Content-Type: application/json']);
    }

    public function read($parameters)
    {
        if($parameters)
        {
            extract($parameters);

            $pk = $this->dbContext->$entity->getPrimaryKey();
            $data = [
                $entity => [
                    $this->dbContext->$entity->set([$pk=>$id])->get()->firstOrDefault()
                ]
            ];

            $template = new Template($template.'.php', $data);
            $page = (object) array('template' => $template);
            $view = new View($page);

            new Response($view->renderTemplate(), 200, ['Content-Type: application/json']);
        }
        else
        {
            new Response('', 404);
        }
    }

    public function update($parameters)
    {
        new Response('works', 200, ['Content-Type: application/json']);
    }

    public function delete($parameters)
    {
        new Response('works', 200, ['Content-Type: application/json']);
    }


    public function new($parameters)
    {

    }


    function childView()
    {
        $childView = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_URL);

        $view = new View($this->page);
        echo json_encode($view->renderChildView($childView));
    }
}