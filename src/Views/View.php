<?php

namespace Views;

use \ViewModels\Builders\HtmlBuilder;

class View
{
    public $docType = '<!DOCTYPE html>';
    public $htmlTop = '<html lang="en">';
    public $htmlBottom = '</html>';
    public $head = '
    <title>Document</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/buffer.js"></script>
    <script src="js/taskHandler.js"></script>
    <script src="js/layout.js"></script>
    <script src="js/sideBar.js"></script>
    <script src="js/mainContent.js"></script>
    <script src="js/home.js"></script>
    <script src="js/lesson.js"></script>';

    public $body = '';

    public $elements = [];
    public $layoutClasses = '';

    public function __construct($elements = [], $layoutClasses='')
    {
        // $viewModel = '\ViewModels\\'.$pageName.'ViewModel';

        // $this->viewModel = new $viewModel($pageData);

        // if(is_array($elements) && count($elements) > 0)
        // {
        //     foreach($elements as $element)
        //     {
        //         $this->body .= $element;
        //     }
        // }

        // if(is_array($viewModels) && count($viewModels) > 0)
        // {
        //     foreach($viewModels as $viewModel)
        //     {
        //         $this->body .= $viewModel->render();
        //     }
        // }

        $this->elements = $elements;
        $this->layoutClasses = $layoutClasses;
    }


    public function render()
    {
        $htmlBuilder = new HtmlBuilder();

        $content = '';

        foreach($this->elements as $element)
        {
            $content .= $element;
        }

        $this->body .= $htmlBuilder->buildElement('div')
                                    ->id('layout')
                                    ->classList($this->layoutClasses)
                                    ->content($content)
                                    ->create();


        $viewData = array($this->docType, $this->htmlTop, $this->head, $this->body, $this->htmlBottom);

        $view = '';
        if (count($viewData) > 0)
        {   
            ob_start();

            foreach($viewData as $data)
            {
                echo $data;
            }

            $view = ob_get_clean();
        }

        echo $view;

    }
}