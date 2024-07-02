<?php

namespace Controllers\API;

use Controllers\Controller;
use Controllers\API\HTTP\Response;
use Controllers\API\HTTP\Request;
use Views\View;
use Views\Elements\Form;
use Views\Elements\Panel;
use Views\Elements\Sidebar;
use Views\Elements\Table;

class ReadController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();       
    }


    public function table($parameters)
    {
        if ($parameters)
        {
            extract($parameters);
            if (isset($table) && isset($this->dbContext->$table))
            {
                $table = new Table($this->dbContext->$table);
                new Response($table->create(), 200);
                return; 
            }
        }
        new Response('<p id="main" style="color:red">data not found</p>', 404);
    }


    public function menu($parameters)
    {
        if ($parameters)
        {
            extract($parameters);
            if(isset($id))
            {
                $table = $this->dbContext->page_table;

                $pages =  $table->set(['page_parent'=>$id, 'page_status'=>'true', 'page_inmenu'=>'true'])
                                ->orderBy(['page_title'])
                                ->get(['page_title', 'page_id'])
                                ->with($table, 'children', ['page_parent'=>'page_id'], ['page_title', 'page_id', 'page_parent'], ['page_title'], true)
                                ->toArray();

                if ($pages)
                {
                    $sidebar = new Sidebar(false, ...$pages);
                    $sidebar->addAttributes(['class'=>'w3-col primaryBackground']);
                    new Response($sidebar->create(), 200);
                    return;
                }
            }
        }
        new Response('<p id="main" style="color:red">data not found</p>', 404);
    }


    public function pageContent($parameters)
    {
        if ($parameters)
        {
            extract($parameters);
            if(isset($id))
            {
                $page = $this->dbContext->page_table->set(['page_id'=>$id])->get(['page_title', 'page_content'])->firstOrDefault();
                if ($page)
                {
                    $panel = new Panel($page['page_title'], [urldecode($page['page_content'])]);

                    new Response($panel->create(), 200);
                    return;
                }
            }
        }
        new Response('<p id="main" style="color:red">data not found</p>', 404);
    }


}