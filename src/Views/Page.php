<?php

namespace Views;

use Views\Includes\Includes;
use Views\Layout;
use Views\View;
use \utilities as u;
use \config;

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

class Page
{
    public string $docType = '<!DOCTYPE html>';
    public string $lang = 'en';
    public string $title = 'Document';
    public string $icon = '<link rel="icon" type="image/x-icon" href="/images/favicon.ico">';

    public array $metaTags = [

        'charset="UTF-8"',
        // 'name="robots" content="noindex"',
        // 'http-equiv="refresh" content="30"'
    
    ];


    public int $tabIndex=1;

    public View $body;

    public function __construct(...$elements)
    {
        // $count = count($elements);
        // $elements[$count-1]->addAttributes(['class'=>'w3-rest', 'style'=>'position:relative;height:100%;overflow:auto;']);
        // for($i=$count-2;$i>0;$i--)
        // {
        //     $elements[$i]->addAttributes(['class'=>'w3-col', 'style'=>'position:relative;height:100%;overflow:auto;']);
        // }

        $this->body = new View(...$elements);
        // $this->body->addAttributes(['class'=>'w3-row', 'style'=>'position:relative;height:100%;']);
        $this->body->setTagName('body');
        
        $css = '
            body {
                padding-top:100px;
                height: 100vh;
            }
        ';

        config::includes(['stylesheet'=>$css]);
    }

    
    public function render()
    {
        
        $page =  $this->docType;
        $page .= '<html lang="'.$this->lang.'">';

        $head =     '<head>';
        $head .=        '<title>'.$this->title.'</title>';
        foreach($this->metaTags as $tag)
        {
            $head .= '<meta '.$tag.'>';
        }
        $head .=        Includes::app();
        $head .=    '</head>';

        $page .= $head;
        $page .= $this->body->create();
        $page .=  '</html>';

        echo $page;        
    }

    public function get($property)
    {
        if (property_exists($this, $property))
        {
            return $this->$property;
        }
        else
        {
            return false;
        }
    }

    public function set($property, $value)
    {
        if (property_exists($this, $property))
        {
            $this->$property = $value;
            return true;
        }
        else
        {
            return false;
        }
    }

}
