<?php

namespace Controllers;

use Models\Menu;
use ViewModels\SideViewModel;
use ViewModels\NavViewModel;
use ViewModels\MainViewModel;
use Views\View;

class CurriculumController extends Controller
{

    use \ViewModels\Builders\ClassList;

    public function home()
    {
        $menuName = filter_input(INPUT_GET, 'menu', FILTER_SANITIZE_URL);

        // die($menuName);

        // pull data to be sent to the view
        $menu = new Menu();

        $navItems = $menu->get('menu.csv', ['title' => ['home']]);
        $navItems = $menu->addSubMenus($navItems, 'menu.csv');

        $sideMenu = $menu->get('menu.csv', ['title' => [$menuName]]);
        $sideMenu = $menu->addSubMenus($sideMenu, 'menu.csv');

        // var_dump($sideMenu);

        // decide how it will be displayed: 
        // ViewModels, 
        $navContent = new NavViewModel(reset($navItems));
        $sideContent = new SideViewModel(reset($sideMenu));
        // $mainContent = new MainViewModel($pageData['mainContent']);

        // Classes, etc..
        $navClasses = $this->navClasses();
        $sideClasses = $this->sideClasses();
        // $mainClasses = $this->mainClasses();

        // elements to be rendered in mainContent area with their classList
        $elements = array();

        array_push($elements, $navContent->render($navClasses));
        array_push($elements, $sideContent->render($sideClasses));
        // array_push($elements, $mainContent->render($mainClasses));

        $view = new View($elements, $this->layoutClasses()['curriculumLayout']);
        $view->render();

    }

}