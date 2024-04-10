<?php

namespace Controllers;

use Models\Menu;
use Models\File;
use Views\View;

class MenuController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function menus()
    {
         // pull common data to be sent to the view
        $data = $this->getData();
 
        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        $menu = new Menu();
        $data['template']['data'] = ['menus' => $menu->get()];

        $view = new View($data);

        $view->render();
    }


    public function allTables()
    {
         // pull common data to be sent to the view
         $data = $this->getData();

        $data['template']['page'] = 'templates\tables.php';

        $file = new File();
        $data['template']['data'] = ['menus' => $file->getAll()];
        // $tables = $menu->get('menu.csv', ['parent' => [12]]);

        $view = new View($data);

        $view->render();
    }  
}