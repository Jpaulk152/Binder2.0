<?php

namespace Controllers;

use Models\DB\Select;
use ViewModels\SideViewModel;
use ViewModels\NavViewModel;
use ViewModels\MainViewModel;
use Views\View;

class CurriculumController extends Controller
{

    use \ViewModels\Builders\ClassList;

    public function home()
    {
       
        // pull data to be sent to the view
        $select = new Select();
        // $pageData = $select->from('AFJROTC_Curriculum');

        $pageData = $select->from('AFJROTC_Curriculum');

        // die(var_dump($this->navClasses()));

        // decide how it will be displayed: 
        // ViewModels, 
        $navContent = new NavViewModel($pageData['navContent']);
        $sideContent = new SideViewModel($pageData['sideContent']);
        $mainContent = new MainViewModel($pageData['mainContent']);

        // Classes, etc..
        $navClasses = $this->navClasses();
        $sideClasses = $this->sideClasses();
        $mainClasses = $this->mainClasses();

        $layoutClasses = $this->layoutClasses();

        // elements to be rendered in mainContent area with their classList
        $elements = array();

        array_push($elements, $navContent->render($navClasses));
        array_push($elements, $sideContent->render($sideClasses));
        array_push($elements, $mainContent->render($mainClasses));

        $view = new View($elements, $layoutClasses['curriculumLayout']);

        // $this->render('index', ['page' => $page->render()]);

        $view->render();

    }

}