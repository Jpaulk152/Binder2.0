<?php

namespace Views;
use Views\ViewModels\SideViewModel;
use Views\ViewModels\NavViewModel;

use Views\ViewModels\Builders\HtmlBuilder;


// responsible for displaying data; expects page data and decides how to display it
class View
{
    public $body = '';
    public $page = null;
    public $template = null;

    public function __construct($page=null)
    {
        $this->page = $page;
    }


    public function render()
    {
        include 'top.php';
        
        $htmlBuilder = new HtmlBuilder();
        $content = '';
        $tabIndex = 1;

        if(!isset($this->page))
        {
            echo 'no data provided';
            return;
        }

        $mainContentClasses = '';
        // expand viewModels with their data and classes
        if(isset($this->page->children))
        {
            foreach($this->page->children as $view=>$child)
            {
                if ($view == 'side') {$mainContentClasses.='mainContentToRight';}

                $viewModel = 'Views\ViewModels\\' . ucfirst($view) . 'ViewModel';
                
                $viewModel = new $viewModel($child['data'], $tabIndex);
                $content .= $viewModel->render($child['classes']);

            }
        }

        // add templates to the mainContent
        if(isset($this->page->template) && isset($this->page->data))
        {
            $this->template = new Template($this->page->template, $this->page->data);

            $templateContent = '';
            $templateContent .= $this->template->render();

            $content .= $htmlBuilder->buildElement('div')
                                    ->id('mainContent')
                                    ->classList('w3-container mainContent ' . $mainContentClasses)
                                    ->content($templateContent)
                                    ->create(); 
        }
        else if(isset($this->page->content))
        {
            $content .= $htmlBuilder->buildElement('div')
                                    ->id('mainContent')
                                    ->classList('w3-container mainContent ' . $mainContentClasses)
                                    ->content($this->page->content)
                                    ->create(); 
        }




        $this->body .= $htmlBuilder->buildElement('div')
                                    ->id('layout')
                                    ->classList('homeLayout')
                                    ->content($content)
                                    ->create();   


        
                                    

        echo $this->body;

        include 'bottom.php';

    }
}




class Template{

    public $page;
    public $data;

    public function __construct($page, $data)
    {
        $this->page = $page;
        $this->data = $data;
    }

    public function render()
    {
        if (!$this->data)
        {
            return 'data not found';
        }

        ob_start();
        extract($this->data);
        include($this->page);
        return ob_get_clean();
    }
}