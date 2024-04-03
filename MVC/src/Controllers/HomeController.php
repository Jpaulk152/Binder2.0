<?php

namespace Controllers;

use Models\Journal;
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
        $homeViewModel = new HomeViewModel();

        $elements = $homeViewModel->renderLayout();

        $page = new View($elements);

        $this->render('index', ['page' => $page->render()]);
    }
}