<?php

namespace Controllers;

use Models\Content;
use Views\View;

class ContentController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function index()
    {
        // pull common data to be sent to the view
        $data = $this->getData();

        $content = $this->context->Content->fetchAll();
 
        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        
        $data['template']['data'] = ['tables' => $content];

        $view = new View($data);

        $view->render();
    }

    public function detail()
    {
        $data = $this->getData();

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
        $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_URL);

        $this->context->Content->set(['id'=>$id, 'title'=>$title]);

        $content = $this->context->Content->fetchAll();

        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        
        $data['template']['data'] = ['tables' => $content];

        $view = new View($data);

        $view->render();
    }
    
}