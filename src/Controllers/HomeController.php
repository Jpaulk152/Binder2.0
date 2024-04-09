<?php

namespace Controllers;

use Models\Menu;
use Views\View;

class HomeController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function index()
    {
        $data['template']['page'] = 'index.php';
        $data['template']['data'] = ['title' => 'index', 'message' => 'Welcome to the Index Page!'];
        $view = new View($data);
        $view->render();
    }


    public function home()
    {
        $data = $this->getData();

        $view = new View($data);

        $view->render();
    }

}