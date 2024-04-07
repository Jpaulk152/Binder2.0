<?php

namespace Controllers;

use Models\Journal;
use Models\Menu;
use ViewModels\SideViewModel;
use ViewModels\NavViewModel;
use ViewModels\MainViewModel;

use Views\View;

class HomeController extends Controller
{
    use \ViewModels\Builders\ClassList;

    public function index()
    {
        $view = new View([], '', 'index');
        $view->render();
    }


    public function home()
    {
        // pull data to be sent to the view
        $menu = new Menu();

        $navItems = $menu->get('menu.csv', ['title' => ['home']]);
        $navItems = $menu->addSubMenus($navItems, 'menu.csv');
        
        $sideMenu = $menu->get('menu.csv', ['title' => ['home']]);
        $sideMenu = $menu->addSubMenus($sideMenu, 'menu.csv');


        // decide how it will be displayed: 
        // ViewModels, 
        $navContent = new NavViewModel(reset($navItems));
        $sideContent = new SideViewModel(reset($sideMenu));
        // $mainContent = new MainViewModel($pageData['mainContent']);

        // Classes, etc..
        $navClasses = $this->navClasses();
        $sideClasses = $this->sideClasses();
        $mainClasses = $this->mainClasses();

        // elements to be rendered in mainContent area with their classList
        $elements = array();

        array_push($elements, $navContent->render($navClasses));
        // array_push($elements, $sideContent->render($sideClasses));
        // array_push($elements, $mainContent->render($mainClasses));

        $view = new View($elements, $this->layoutClasses()['homeLayout']);

        // $this->render('index', ['page' => $page->render()]);

        $view->render();
    }

    public function menus()
    {
    
        $menu = new Menu();

        // $tables = $menu->getAll();
        $tables = $menu->get('menu.csv', ['parent' => [12]]);
        $menuItems = reset($tables);


        if (!$tables)
        {
            echo 'data not found';
            return;
        }

        include '../src/Views/menus.php';
    }









    public function welcome()
    {
        $this->render('welcome');
    }

    public function journal()
    {
        $journals = [
            new Journal('My Third Journal Entry', '2023'),
            new Journal('My Second Journal Entry', '2022'),
            new Journal('My First Journal Entry', '2021')
        ];

        $this->render('journal', ['journals' => $journals]);
    }

   
}