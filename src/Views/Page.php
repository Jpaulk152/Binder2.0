<?php

namespace Views;

use Views\Includes\Includes;
use Views\Layout;
use \utilities as u;

/*
->setDoctype(\Pyrech\Layout::DOCTYPE_HTML5)
->addMeta('charset', 'utf-8')
->addTitle('My wonderful title')
->addMeta('description', 'Description of your page')
->addMeta('robot', 'index')
->addMeta('http-equiv:refresh', '60') // If the key attribute is not 'name', prefix the value by the attribute then ':''
->addIcon('/favicon.png', 'png')
->addIcon('/favicon.ico', 'ico')
->addStyle('/my-stylesheet.css') // Default media is 'all'
->addStyle('/print.css', 'print')
->addScript('/my-javascript.js', \Pyrech\Layout::SCRIPT_DEFER)
->addScript('alert("Hello World!");', \Pyrech\Layout::SCRIPT_INTERNAL)
->addBodyClass(array('some-class', 'another-class')); // Array of classes or a string with several classes
 */

class Page extends HTMLBuilder
{
    public $content = null;
    public $layout = null;
    public $views = null;
    public $title = 'Document';


    public function __construct($content=null)
    {
        $this->content = $content;
    }

    public function render()
    {
        echo '<!DOCTYPE html>
                <html lang="en">
                    <head>
                        <title>'.$this->title.'</title>';

                        Includes::css();
                        Includes::js();

        echo        '</head>';


        if(!empty($this->layout))
        {
            $this->content = $this->layout->render();
        }
        else if(!empty($this->views))
        {
            foreach($this->views as $view)
            {
                $this->content .= $view->render();
            }
        }
        else
        {
            $this->content = $this->build('div')
                                    ->attr('class', 'w3-panel w3-blue')
                                    ->content(!empty($this->content) ? $this->content : 'No content provided')
                                    ->create();
        }
       

        $body = $this->build('body')
                    ->content($this->content)
                    ->create();

        echo $body;

        echo '</html>';
    }

    public function setLayout($layout)
    {
        if((is_a($layout, 'Layouts\Layout')) || (get_parent_class($layout) == 'Views\Layouts\Layout'))
        {
            $this->layout = $layout;
        }
        else
        {
            new ViewError('setLayout passed parameter this is not of type Layout');
        }
    }

    public function addView($view)
    {
        if (is_a($view, 'View'))
        {
            if (is_null($this->views))
            {
                $this->views = array();
            }
            array_push($this->views, $view);
        }
        else
        {
            new ViewError('addView passed parameter this is not of type View');
        }
    }
}