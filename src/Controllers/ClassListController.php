<?php

namespace Controllers;

use Views\View;

class ClassListController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function index()
    {
        // pull common data to be sent to the view
        $data = $this->getData();

        $classLists = $this->context->ClassLists->fetchAll();
 
        // die(var_dump($classLists));

        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        
        $data['template']['data'] = ['tables' => $classLists];

        $view = new View($data);

        $view->render();
    }

    public function detail()
    {
        $data = $this->getData();

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
        $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_URL);
        $view = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_URL);


        $this->context->ClassLists->set(['id'=>$id, 'title'=>$title, 'view'=>$view]);

        $classLists = $this->context->ClassLists->fetchAll();

        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        
        $data['template']['data'] = ['tables' => $classLists];

        $view = new View($data);

        $view->render();
    }
    
}