<?php

namespace Controllers;

use Views\View;

class CurriculumController extends Controller
{

    use \ViewModels\Builders\ClassList;

    public function home()
    {
        $menuName = filter_input(INPUT_GET, 'menu', FILTER_SANITIZE_URL);

        // pull common data to be sent to the view
        $data = $this->getData($menuName);

        $view = new View($data);

        $view->render();
    }
}