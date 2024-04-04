<?php

namespace Controllers;

use ViewModels\CurriculumViewModel;
use Views\View;

class CurriculumController extends Controller
{

    public function home()
    {
        $curriculumViewModel = new CurriculumViewModel('home');

        $elements = $curriculumViewModel->renderLayout();

        // die(var_dump($elements));

        $page = new View($elements);

        $this->render('curriculum', ['page' => $page->render()]);
    }

}