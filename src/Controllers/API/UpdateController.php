<?php

namespace Controllers\API;

use Controllers\Controller;
use Controllers\API\HTTP\Response;
use Views\View;
use Views\Defaults\Form;
use Views\Defaults\Table;
use Views\Menus\ProgressView;

class APIController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();       
    }


    public function create($parameters)
    {
        extract($parameters);

        if (isset($entity) && isset($values))
        {
            $object = $this->dbContext->$entity->new($values);
            $affectedRows = $this->dbContext->$entity->insert($object);
    
            if ($affectedRows > 0)
            {
                $objects = $this->dbContext->$entity->get()->objects();

                // structure html with a template, optional method is for submitting forms
                $view = new Table($entity, $objects);

                // $page = (object) array('template' => $template);
                // $view = new View($page);

                new Response($view->create(), 200);
                return;
            }
            else
            {
                new Response('<p id="mainContent" style="color:red">could not create entry</p>', 500);
                return;
            }
        }

        new Response('<p id="mainContent" style="color:red">entity not provided</p>', 500);
    }



    public function read($parameters)
    {
        // new Response('<p style="color:red">data not found</p>', 404);
        new Response($parameters, 404);
        return;
    


        extract($parameters);

        if (isset($entity))
        {
            // if we want to set the primary key
            $setPK = (isset($setPK) && $setPK == true) ? $setPK : false;

            // if a method is specified
            if (isset($method))
            {
                switch ($method)
                {
                    case 'create':
                        $object = $this->dbContext->$entity->new([], $setPK);
                        break;
                    
                    case 'update':
                        if (!isset($id)){new Response('<p id="mainContent" style="color:red">must provide id to update</p>', 404); return;}
                        $pk = $this->dbContext->$entity->getPrimaryKey();
                        $object = $this->dbContext->$entity->set([$pk=>$id])->get()->firstOrDefault();
                        break;

                    default:
                        new Response('<p id="mainContent" style="color:red">invalid method name</p>', 404);
                        return;
                }
            }
            else
            {
                // if there is an id, get a specific entry
                if (isset($id))
                {
                    
                }
                // otherwise get an array of all entities from the set
                else
                {
                    $object = $this->dbContext->$entity->get()->objects();
                }
            }
           
            $view = new \ReflectionClass('Views\\Defaults\\'.$view);
            $args = array($entity, $object);
            if(isset($type)) 
            {
                array_push($args, $type);
                if(isset($method)) {array_push($args, $method);}
            }
            $view = $view->newInstanceArgs($args);

            // $view = new ProgressView($object);


            new Response($view->create(), 200);

            return;
        }

        new Response('<p id="mainContent" style="color:red">data not found</p>', 404);
    }












    public function update($parameters)
    {
        new Response('works', 200, ['Content-Type: application/json']);
    }

    public function delete($parameters)
    {
        new Response('works', 200, ['Content-Type: application/json']);
    }

}