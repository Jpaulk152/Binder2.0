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
    public $layout;
    public $views;

    public function __construct($layout=null, $views=[])
    {
        $this->layout = $layout;
        $this->views = $views;

        $this->layout = new Layout('homeLayout');
        $this->layout->addZone($this->views[0])
                    ->attr('class', 'navMenuContainer secondaryBackground w3-bar w3-card-4')
                    ->attr('id', 'navContent');

        $this->layout->addZone($this->views[1])
                    ->attr('id', 'sideContent');



        // $subLayout = new Layout('')


        $this->layout->addZone()
                    ->attr('class', 'w3-container mainContent mainContentToRight')
                    ->attr('id', 'mainContent');

    }


    public function render()
    {
        echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <title>testing new page</title>';

                    Includes::css();
                    Includes::js();

        echo    '</head>';


        // echo '<body></body>';
        // u::dd($this->layout);

        if(empty($this->layout))
        {
            new ViewError('No layout provided.');
        }
        if(empty($this->views))
        {
            new ViewError('No view provided.');
        }
        if(empty($this->layout->zones))
        {
            new ViewError('This layout has no zones. You may add them manually using the addZone() function');
        }



        $body = $this->build('body')
                        ->attr('class', 'homeLayout')
                        ->content($this->layout->render())
                        ->create();

        echo $body;

        echo '</html>';
    }
}