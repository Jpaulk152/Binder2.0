<?php

namespace Controllers;

use Models\Menu;
use Models\File;
use Models\Page;
use Views\View;
use Views\View2;

class TestController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function test1()
    {
         // pull common data to be sent to the view
        $data = $this->getData();
 
        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        $page = new Page();
        $data['template']['data'] = ['menus' => $page->get()];

        $view = new View($data);

        $view->render();
    }


    public function test2()
    {
         // pull common data to be sent to the view
         $data = $this->getData();

        $data['template']['page'] = 'templates\tables.php';

        $page = new Page();
        $data['template']['data'] = ['menus' => $page->getAll()];
        // $tables = $menu->get('menu.csv', ['parent' => [12]]);

        $view = new View($data);

        $view->render();
    } 

    public function test3()
    {
        // pull common data to be sent to the view
        $data = $this->getData();

        // $data['test']['data'] = 'this is a test';

        $page = new Page();

        $page->title = 'home';
        $page->inMenu = false;
        $page->parent = null;

        $info = $page->get();

        $data['test']['data'] = $info;

        $view = new View2($data);

        $view->render();
    }


    
}