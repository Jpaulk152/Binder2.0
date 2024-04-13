<?php

namespace Controllers;

use Views\View;

class HomeController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function index()
    {
        $data['template']['page'] = 'templates\index.php';
        $data['template']['data'] = ['title' => 'index', 'message' => 'Welcome to the Index Page!'];
        $view = new View($data);
        $view->render();
    }


    public function home()
    {
        // pull common data to be sent to the view
        $data = $this->getData('main_content');

        // die(var_dump($data['viewModels'][0]['data']));

        $view = new View($data);

        $view->render();
    }
}