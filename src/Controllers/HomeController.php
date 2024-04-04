<?php

namespace Controllers;

use Models\Journal;
use Models\DB\Select;
use ViewModels\HomeViewModel;
use Views\View;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('index');
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

    public function home()
    {

        // $elements = $homeViewModel->renderLayout();

        $select = new Select();
        $pageData = $select->from('AFJROTC_Curriculum');

        

        $view = new View('SideContent', $pageData);

        // $this->render('index', ['page' => $page->render()]);

        $view->render();
    }
}