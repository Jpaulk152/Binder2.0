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

        $content = $this->context->Content->exec();
 
        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        
        $data['template']['data'] = ['menus' => $content];

        $view = new View($data);

        $view->render();
    }
    
}