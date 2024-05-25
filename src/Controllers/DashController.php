<?php

namespace Controllers;

use Views\Page;
use Views\Layouts\DefaultLayout;
use Views\Layouts\TestLayout;
use Views\View;

use \utilities as u;

class DashController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        $testNavItems = [
            // tests
            (object) array ('name'=>'Unit Tests', 'link'=>'javascript:alert(`this is a test...`)', 'children' => 
                [
                    (object)array('name'=>'test whatever', 'link'=>'dash/test'),
                    (object)array('name'=>'getHomeNav', 'link'=>'javascript:getView(`nav`, `navContent`);'),
                    (object)array('name'=>'testPages', 'link'=>'javascript:testReplace(`testPages`, `mainContent`);'),
                    (object)array('name'=>'testDBFields', 'link'=>'javascript:runTest(`testDBFields`);'),
                    (object)array('name'=>'testCSVFields', 'link'=>'javascript:runTest(`testCSVFields`);'),
                    (object)array('name'=>'build_admin', 'link'=>'javascript:runTest(`build_admin`);'),
                ]
            ),

            // jsFunctions
            (object)array('name'=>'JS Tests', 'link'=>'#', 'children' =>
                [
                    (object)array('name'=>'testHomeSide', 'link'=>'javascript:runTest(`testHomeSide`);'),
                    (object)array('name'=>'testHomeNav', 'link'=>'javascript:runTest(`testHomeNav`);'),
                    (object)array('name'=>'Attach Home Side Bar', 'link'=>'javascript:getChildView(`home`, `side`);'),
                    (object)array('name'=>'Detach Side Bar', 'link'=>'javascript:detachChildView(`side`);'),
                ]
            ),
        ];

        $tables = $this->dbContext->allTables();
        $tableNavItem = [];
        for ($i=0;$i<count($tables);$i++)
        {
            $params = '{entity: `'.$tables[$i].'`, view: `Tables/default`}';
            $tableNavItem[$i] = (object)array('name'=>$tables[$i], 'link'=>'javascript:read('.$params.')');

            $params1 = '{entity: `'.$tables[$i].'`, view: `Forms/default`, method: `create`}';
            $params2 = '{entity: `'.$tables[$i].'`, view: `Forms/default`, method: `create`, setPK: `true`}';
            $tableNavItem[$i]->children = [
                (object)array('name'=>'new', 'link'=>'javascript:read('.$params1.')'),
                (object)array('name'=>'new (set primary key)', 'link'=>'javascript:read('.$params2.')'),
            ];
        }

        $nav  = array_merge($testNavItems, $tableNavItem);

        $data = $this->dbContext->page->new();

        $this->page = new Page();
        $layout = new TestLayout([$nav], [$nav], $data);

        $this->page->setLayout($layout);
        $this->page->title = 'Dashboard';

    }

    public function index()
    {
        $this->page->render();
    }


    function info()
    {
        phpinfo();
    }
}