<?php

namespace Controllers\API;

use Controllers\Controller;
use Controllers\API\HTTP\Response;
use Controllers\API\HTTP\Request;

use Views\View;
use Views\Layout;
use Views\Defaults\Form;
use Views\Defaults\Table;
use Views\Defaults\Gauge;

class HCController extends Controller
{
    public function __construct()
    {
        parent::__construct();       
    }


    public function menu($parameters)
    {
        // new Response('<p style="color:red">data not found</p>', 404);
        // new Response($parameters, 300);
        // return;    

        extract($parameters);

        if (isset($id) && isset($view))
        {
            $menu = $this->getMenu($id, $view);
            
            // $response = [$menu->bundle];

            $bundle = $menu->getBundle('style');

            new Response([$menu->create(), $bundle], 200);
        }
        else
        {
            new Response('<p style="color:red">data not found</p>', 404);
        }        
    }


    public function pageContent($parameters)
    {
        extract($parameters);

        if (isset($id))
        {
            $page = $this->dbContext->page_table->set(['page_id'=>$id])->get(['page_content'])->firstOrDefault();
            $pageContent = '';
            if ($page)
            {
                $pageContent = new View(urldecode($page->page_content), ['id'=>'main', 'class'=>'w3-container']);
            }

            new Response($pageContent->create(), 200);
        }
        else
        {
            new Response('<p style="color:red">data not found</p>', 404);
        }        
    }


    protected function getMenu($id, $view) : View
    {
        $objects = $this->dbContext
        
        ->page_table
        ->set(['page_parent'=>$id, 'page_status'=>'true', 'page_inmenu'=>'true'])
        ->orderBy(['page_title'])
        ->get(['page_title', 'page_id'], function ($object){
                return $this->addView($object);
            }
        )
        ->toEntities();

        // $objects = $this->dbContext->page_table->getChildren($objects, 'page_parent', 'page_title');

        $this->addLinks($objects);

        return new $view('side', $objects);
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
            entity: $object['page_title'], 
            attributes: ['id'=>'title', 'class'=>'w3-container w3-twothird']
        );

        $display = new Layout(
            views: [$title, $progress], 
            attributes: ['id'=>'disp','style'=>'display:flex; align-items:center; width: 100%']
        );

        return [ 'page_title'=>$display, 'page_id'=>$object['page_id'] ];
    }

    public function addLinks(array $objects)
    {
        foreach($objects as $object)
        {
            $function = 'hcPageContent';
            $target = 'main';

            $params = ['id'=>$object->id];
            $link = $function . '('.$this->toJSON($params).', `'.$target.'`)';

            $object->id = $link;

            if (property_exists($object, 'children'))
            {
                $this->addLinks($object->children);
            }
        }
    }
}