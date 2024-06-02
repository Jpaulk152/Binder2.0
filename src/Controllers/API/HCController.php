<?php

namespace Controllers\API;

use Controllers\Controller;
use Controllers\API\HTTP\Response;
use Controllers\API\HTTP\Request;
use Views\View;
use Views\Defaults\Form;
use Views\Defaults\Table;
use Views\Menus\Sidebar;
use Views\Menus\ProgressView;

class HCController extends Controller
{
    public function __construct()
    {
        parent::__construct();       
    }


    public function menu($parameters)
    {
        // new Response('<p style="color:red">data not found</p>', 404);
        //   new Response($parameters, 300);
        // return;

        $function = 'hcPageContent';
        $target = 'mainView';

        extract($parameters);

        if (isset($id))
        {
            $objects = $this->dbContext->page_table->set(['page_parent'=>$id, 'page_status'=>'true', 'page_inmenu'=>'true'])->orderBy(['page_title'])->get(['page_title', 'page_id'])->objects();           
            $objects = $this->dbContext->page_table->children($objects, foreignKey: 'page_parent', fields: ['page_title', 'page_id'], orderBy: 'page_title');

            $parameters = array();
            $sideItems = array();
            for ($i=0;$i<count($objects); $i++)
            {
                // $filter = '{page_parent: `'.$navItems[$i]->page_id.'`, page_status: `true`, page_inmenu: `true`}';
                $parameters['id'] = $objects[$i]->page_id;

                $link =  $function . '('.$this->toJSON($parameters).', `'.$target.'`, event)';

                // $params = '{id: `'.$navItems[$i]->page_id.'`}, `menu`, `view2`';
                $sideItems[$i] = (object)array('name'=>$objects[$i]->page_title, 'link'=> $link);
                if (isset($objects[$i]->children))
                {
                    $sideItems[$i]->children = $objects[$i]->children;
                }
            }

            $sideBar = '';
            if (!empty($sideItems))
            {
                $sideBar = new Sidebar('side', $sideItems, [], $GLOBALS['style']);
                $sideBar = $sideBar->create();
            }            

            new Response($sideBar, 200);
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
                $pageContent = new View('mainView', urldecode($page->page_content), ['class'=>'w3-container']);
            }

            new Response($pageContent->create(), 200);
        }
        else
        {
            new Response('<p style="color:red">data not found</p>', 404);
        }        
    }
}