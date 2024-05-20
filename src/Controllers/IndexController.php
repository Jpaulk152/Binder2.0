<?php

namespace Controllers;

use Views\View;
use \utilities as u;
use Views\Templates\Template;

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


        $params = '{name: `page`, id: `2`, template: `forms/default`}';

        $nav1 = [
            (object)array('name'=>'CRUD functions', 'link'=>'javascript:alert(`CRUD!!!`)', 'children'=>[
                (object)array('name'=>'create(`page`)', 'link'=>'javascript:create(`page`)'),
                (object)array('name'=>'read('.$params.')', 'link'=>'javascript:read('.$params.')'),
                (object)array('name'=>'update(`page`,`1`)', 'link'=>'javascript:update(`page`,`1`)'),
                (object)array('name'=>'del(`page`,`3`)', 'link'=>'javascript:del(`page`,`3`)')
            ])
        ];



        $tables = $this->dbContext->allTables();
        $nav2 = [];

        for ($i=0;$i<count($tables);$i++)
        {
            $params = '{entity: `'.$tables[$i].'`, template: `tables/default`}';
            $nav2[$i] = (object)array('name'=>$tables[$i], 'link'=>'javascript:read('.$params.')');

            $params1 = '{entity: `'.$tables[$i].'`, template: `forms/default`, method: `create`}';
            $params2 = '{entity: `'.$tables[$i].'`, template: `forms/default`, method: `create`, setPK: `true`}';
            $nav2[$i]->children = [
                (object)array('name'=>'new', 'link'=>'javascript:read('.$params1.')'),
                (object)array('name'=>'new (set primary key)', 'link'=>'javascript:read('.$params2.')'),
            ];
        }


        // $this->csvContext->Page->set(['title'=>'home']);
        // $nav2 = $this->csvContext->Page->get()->fields(['name','link', 'id'])->objects();
        // $nav2 = $this->addChildren($nav2, $this->csvContext->Page);

        $nav  = array_merge($nav1, $nav2);


        $this->page = (object) array('title'=>'Index', 'content'=>'Index'); 
        $this->page->children['nav']['data'] = $nav;
        $this->page->children['nav']['classes'] = $this->getClasses('nav');

    }


    
    public function index()
    {

        

        // $newEntity = $this->dbContext->admin_table->getProperties();
        // echo '<body></body>';
        // u::dd($newEntity);


        // $table = 'Test Array';
        // $data1 = [

        //     (object)array
        //     (
        //         'id'=>1,
        //         'field1'=>3,
        //         'field2'=>'something'
        //     ),
        //     (object)array
        //     (
        //         'id'=>2,
        //         'field1'=>3,
        //         'field2'=>'something'
        //     ),
        //     (object)array
        //     (
        //         'id'=>3,
        //         'field1'=>3,
        //         'field2'=>'something'
        //     ),


        // ];


        // $table = 'admin_table';
        // $data2 = $this->dbContext->$table->get()->firstOrDefault();
        // // echo '<body></body>';
        // // u::dd($data2, true);

        // // $newEntity = $this->dbContext->admin_table->getProperties();
        
        // // u::dd($newEntity);

        $data = $this->dbContext->page->new();

        $template = new Template('forms/default.php', ['page'=>$data], 'create');

        $this->page->template = $template;

        $view = new View($this->page);
        echo $view->render();

        // $page = $this->dbContext->page->new([ 'content'=>'null', 'inMenu'=>true, 'isLive'=>true, 'link'=>'#', 'name'=>'test page name', 'parent'=>false, 'title'=>'test page title' ]);
        // $page = $this->dbContext->page->new();

        // $page->content = 'null';
        // $page->link = '#';
        // $page->name = 'another test name2';
        // $page->title = 'another test title2';

        // u::dd($page);

        // $rows = $this->dbContext->page->insert($page);

        // u::dd($rows);
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