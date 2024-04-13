<?php

namespace Controllers;

use Models\Menu;
use Models\File;
use Models\Page;
use Models\Customer;
use Views\View;
use Views\View2;
use Models\DB\CSVSet;
use ViewModels\Builders\ClassList;

class TestController extends Controller
{
    use \ViewModels\Builders\ClassList;

    protected $context;

    public function __construct()
    {
        $this->context = $GLOBALS['_csvContext'];
    }

    public function pages()
    {
         // pull common data to be sent to the view
        $data = $this->getData();

        $pageTables = $this->context->Pages->fetchAll();

        // die(var_dump($pageTables));
 
        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        $data['template']['data'] = ['tables' => $pageTables];

        $view = new View2($data);

        $view->render();
    }


    public function customers()
    {
         // pull common data to be sent to the view
        $data = $this->getData();

        $customerTables = $this->context->Customers->fetchAll();
 
        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        $data['template']['data'] = ['tables' => $customerTables];

        $view = new View2($data);

        $view->render();
    }

    public function content()
    {
         // pull common data to be sent to the view
        $data = $this->getData();

        $contentTables = $this->context->Content->fetchAll();
 
        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        $data['template']['data'] = ['tables' => $contentTables];

        $view = new View2($data);

        $view->render();
    }


    public function test1()
    {
        $this->context->Pages->set(['title' => 'home']);

        $pages = $this->context->Pages->exec();


        for($i=0;$i<count($pages);$i++)
        {
            $this->context->Pages->set(['parent'=>$pages[$i]['id']]);
            $pages[$i]['submenu'] = $this->context->Pages->exec();
        }


        $data = array();
        $viewModels = array();
        $navClasses = $this->navClasses();
        $viewModels[0] = ['data' => [$pages], 'classes' => $navClasses, 'viewModel' => 'NavViewModel'];

        $data['viewModels'] = $viewModels;
        
        // die(var_dump($pages));

        $view = new View2($data);

        $view->render();
    }


    public function test2()
    {
        $page = new Page();
        $set = new CSVSet($page);

        // $set->model->title = 'home';

        $set->set(['title' => 'home']);

        $pages = $set->get()->toList();

        // die(var_dump($pages[1]));

        $view = new View();

        $view->render();
    } 

    public function test3()
    {
        // pull common data to be sent to the view
        $data = $this->getData();


        $data['test']['data'] = 'Here\'s some text for test3';

        $view = new View2($data);

        $view->render();
    }


    
}