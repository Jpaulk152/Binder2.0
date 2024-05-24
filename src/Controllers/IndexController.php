<?php

namespace Controllers;

use Views\View;
use Views\Template;
use Views\Page;
use \utilities as u;

class IndexController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        // from here we should be able to hit any other controller strictly using ajax to pull:
        // - views
        // - content

        // each controller should implement an interface that allows it to return these items

        $tables = $this->dbContext->allTables();
        $nav = [];

        for ($i=0;$i<count($tables);$i++)
        {
            $params = '{entity: `'.$tables[$i].'`, template: `tables/default`}';
            $nav[$i] = (object)array('name'=>$tables[$i], 'link'=>'javascript:read('.$params.')');

            $params1 = '{entity: `'.$tables[$i].'`, template: `forms/default`, method: `create`}';
            $params2 = '{entity: `'.$tables[$i].'`, template: `forms/default`, method: `create`, setPK: `true`}';
            $nav[$i]->children = [
                (object)array('name'=>'new', 'link'=>'javascript:read('.$params1.')'),
                (object)array('name'=>'new (set primary key)', 'link'=>'javascript:read('.$params2.')'),
            ];
        }

        $this->csvContext->Page->set(['title'=>'home']);
        $nav2 = $this->csvContext->Page->get()->fields(['name','link', 'id'])->objects();
        $nav2 = $this->addChildren($nav2, $this->csvContext->Page);
        
        $view = new Template('Navbars/HCDefault.php', [$nav]);
        $view2 = new Template('Sidebars/HCDefault.php', [$nav]);

        $page = new Page('', [$view, $view2]);

        $page->render();

       



        // $this->page = (object) array('title'=>'Index', 'content'=>'Index'); 
        // $this->page->children['nav']['data'] = $nav;
        // $this->page->children['nav']['classes'] = $this->getClasses('nav');

    }


    
    public function index()
    {
        


        // $data = $this->dbContext->page->new();

        // $template = new Template('forms/default.php', ['page'=>$data], 'create');

        

        // $this->page->template = $template;

        // $view = new View($this->page);
        // echo $view->render();




    }


    public function testTemplate()
    {
        $this->index();
    }


    function info()
    {
        phpinfo();
    }

    function redirect($uri)
    {
        $this->page->content = '<p style="color:red">No route found for URI: ' . $uri . '</p>';
        $this->index();
    }

}