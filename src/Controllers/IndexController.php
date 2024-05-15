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


        $params = '{entity: `page`, id: `2`, template: `form/read`}';

        $nav1 = [
            (object)array('name'=>'CRUD functions', 'link'=>'javascript:form()', 'children'=>[
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
            $nav2[$i] = (object)array('name'=>$tables[$i], 'link'=>'javascript:getTable(`'.$tables[$i].'`)');
        }


        // $nav1 = [
        //     // tests
        //     (object) array ('name'=>'Unit Tests', 'link'=>'javascript:alert(`this is a test...`)', 'children' => 
        //         [
        //             (object)array('name'=>'test whatever', 'link'=>'dash/test'),
        //             (object)array('name'=>'getHomeNav', 'link'=>'javascript:getView(`nav`, `navContent`);'),
        //             (object)array('name'=>'testPages', 'link'=>'javascript:testReplace(`testPages`, `mainContent`);'),
        //             (object)array('name'=>'testDBFields', 'link'=>'javascript:runTest(`testDBFields`);'),
        //             (object)array('name'=>'testCSVFields', 'link'=>'javascript:runTest(`testCSVFields`);'),
        //             (object)array('name'=>'build_admin', 'link'=>'javascript:runTest(`build_admin`);'),
        //         ]
        //     ),

        //     // jsFunctions
        //     (object)array('name'=>'JS Tests', 'link'=>'#', 'children' =>
        //         [
        //             (object)array('name'=>'testHomeSide', 'link'=>'javascript:runTest(`testHomeSide`);'),
        //             (object)array('name'=>'testHomeNav', 'link'=>'javascript:runTest(`testHomeNav`);'),
        //             (object)array('name'=>'Attach Home Side Bar', 'link'=>'javascript:getChildView(`home`, `side`);'),
        //             (object)array('name'=>'Detach Side Bar', 'link'=>'javascript:detachChildView(`side`);'),
        //         ]
        //     ),

        //         // Tables
        //         (object)array('name'=>'Tables', 'link'=>'#', 'children' =>
        //         [
        //             (object)array('name'=>'Pages', 'link'=>'javascript:replaceContent(`mainContent`,`table`,`pages`);'),
        //             (object)array('name'=>'ClassLists', 'link'=>'javascript:replaceContent(`mainContent`,`table`,`classLists`);'),
        //         ]
        //     )
        // ];


        // $this->csvContext->Page->set(['title'=>'home']);
        // $nav2 = $this->csvContext->Page->get()->fields(['name','link', 'id'])->objects();
        // $nav2 = $this->addChildren($nav2, $this->csvContext->Page);

        $nav  = array_merge($nav1, $nav2);


        $this->page = (object) array('title'=>'Index', 'content'=>'Test Index'); 
        $this->page->children['nav']['data'] = $nav;
        $this->page->children['nav']['classes'] = $this->getClasses('nav');

    }


    
    public function index()
    {

        $data = array
        (
            'someEntityName' => array
            (
                (object)array
                (
                    'id'=>1,
                    'field1'=>3,
                    'field2'=>'something'
                ),
                // (object)array
                // (
                //     'id'=>2,
                //     'field1'=>3,
                //     'field2'=>'something'
                // ),
                // (object)array
                // (
                //     'id'=>3,
                //     'field1'=>3,
                //     'field2'=>'something'
                // )
            )
        );

        $table = 'page';
        $data = [$table=>$this->dbContext->$table->fetchAll()];

        $template = new Template('form.php', $data);

        $this->page->template = $template;

        $view = new View($this->page);
        echo $view->render();
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