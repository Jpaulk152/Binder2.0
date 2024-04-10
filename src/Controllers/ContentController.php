<?php

namespace Controllers;

use Models\Content;
use Views\View;

class ContentController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function content()
    {
        // pull common data to be sent to the view
        $data = $this->getData();
 
        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        $content = new Content();
        $data['template']['data'] = ['menus' => $content->get()];

        $view = new View($data);

        $view->render();
    }

    public function home()
    {
        // pull common data to be sent to the view
        $data = $this->getData();

        $view = new View($data);

        $view->render();
    }
}