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

class Page extends Layout
{
    public string $docType = '<!DOCTYPE html>';
    public string $meta = '<meta charset="UTF-8">';
    // public string $meta = 'name="robots" content="noindex"';
    // public string $meta = 'name="robots" content="noindex"';
    // public string $meta = 'http-equiv="refresh" content="30"';\
    public string $icon = '<link rel="icon" type="image/x-icon" href="/images/favicon.ico">';
    public string $title = 'Document';
    public int $tabIndex=1;

    public function __construct(array $views, array $attributes=[])
    {
        parent::__construct('layout', $views, $attributes);
    }

    public function render()
    {
        echo $this->docType;

        echo '<html lang="en">';
        echo    '<head>';
        echo        '<title>'.$this->title.'</title>';        

        echo        Includes::css();
        echo        Includes::js();
        
        echo    '</head>';
       

        $body = $this->build('body')
                    ->content($this->element->create())
                    ->create();

        echo $body;




        echo '</html>';
    }

    // public function setLayout($layout)
    // {
    //     if((is_a($layout, 'Layouts\Layout')) || (get_parent_class($layout) == 'Views\Layouts\Layout'))
    //     {
    //         $layout->views = $this->layout->views;
    //         $this->layout = $layout;
    //     }
    //     else
    //     {
    //         new ViewError('setLayout passed parameter this is not of type Layout');
    //     }
    // }

}