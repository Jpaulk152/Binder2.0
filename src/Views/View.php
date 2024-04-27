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
    public $tabIndex = 1;
    public $contentClasses = '';
    public $htmlBuilder;
    public $content = '';


    public function __construct($page=null)
    {
        $this->page = $page;
        $this->htmlBuilder = new HtmlBuilder();
    }


    public function render()
    {
        echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <title>'.$this->page->title.'</title>';

                    include 'top.php';

        echo    '</head>';

        
        
        if(!isset($this->page))
        {
            echo 'no data provided';
            return;
        }

        // expand viewModels with their data and classes
        $this->renderChildren();

        // add templates to the mainContent
        $this->content .= $this->renderTemplate();
        
        $this->content .= $this->renderPageContent();

        $this->body .= $this->htmlBuilder->buildElement('div')
                                    ->id('layout')
                                    ->classList('homeLayout')
                                    ->content($this->content)
                                    ->create();                

        echo $this->body;

        include 'bottom.php';

    }


    public function renderChildren()
    {
        if(isset($this->page->children))
        {
            foreach($this->page->children as $view=>$child)
            {
                if ($view == 'side' && count($child['data']) > 0) 
                {
                    $this->contentClasses.=' mainContentToRight';
                }
                
                $this->content .= $this->renderChildView($view);
            }
        }
    }


    public function renderChildView($view, $itemTitle='name', $itemLink='link')
    {        
        if(isset($this->page->children[$view]))
        {
            $child = $this->page->children[$view];
            $viewModel = 'Views\ViewModels\\' . ucfirst($view) . 'ViewModel';
            $viewModel = new $viewModel($child['data'], $this->tabIndex);

            return $viewModel->render($child['classes'], $itemTitle, $itemLink);
        }
        else
        {
            return '';
        }
    }


    public function renderTemplate()
    {
        if(isset($this->page->template) && isset($this->page->data))
        {
            $this->template = new Template($this->page->template, $this->page->data);

            $templateContent = '';
            $templateContent .= $this->template->render();
    
            return $this->htmlBuilder->buildElement('div')
                                    ->id('mainContent')
                                    ->classList('w3-container mainContent' . $this->contentClasses)
                                    ->content($templateContent)
                                    ->create(); 
        }
        else
        {
            return '';
        }
    }

    public function renderPageContent()
    {
        if(isset($this->page->content))
        {
            return $this->htmlBuilder->buildElement('div')
                                    ->id('mainContent')
                                    ->classList('w3-container mainContent' . $this->contentClasses)
                                    ->content($this->page->content)
                                    ->create(); 
        }
        else
        {
            return '';
        }
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