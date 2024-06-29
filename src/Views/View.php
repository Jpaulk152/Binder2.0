<?php

namespace Views;

use \utilities as u;
use Views\Layout;
use Models\Entity;
use Views\Elements\Element;

// A collection of Elements to be displayed together.
class View extends Element {

    public array $elements = [];
    
    public function __construct(...$elements)
    {
        parent::__construct('div');

        $this->addElements(...$elements);
    }

    public function __clone()
    {
        foreach($this->elements as &$element)
        {
            $element = clone $element;
        }
    }

    public function addElement($element) : Element
    {
        if (is_object($element))
        {
            $element = clone $element;
        }

        if (!is_a($element, Element::class))
        {
            switch($element)
            {
                case is_string($element):
                    $element = new Element('div', $element);
                    break;
    
                case is_a($element, View::class) || is_a($element, Layout::class):
                    $element = new Element('div', $element->create());
                    break;
    
                case is_array($element):
                    $element = new View(...$element);
                    // $element = new Element('div', print_r($element, true));
                    break;
    
                default:
                    $element = new Element('div', 'No content provided');
            }
        }
        array_push($this->elements, $element);

        return $element;
    }

    public function addElements(...$elements)
    {
        foreach($elements as $element)
        {        
            // u::dd($element, true);
            if (!empty($element))
            {
                $this->addElement($element);
            }
        }  
    }

    public function create() : string
    {
        $content = '';
        foreach($this->elements as $element)
        {
            $content .= $element->create();
        }
        $this->content($content);
        return parent::create();
    }

    public function unpackage() : string
    {
        $content = '';
        foreach($this->elements as $element)
        {
            $content .= $element->create();
        }
        return $content;
    }

    public function error($msg)
    {
        new ViewError($msg);
    }
}



use \ApplicationError;

class ViewError extends ApplicationError
{
    public function __construct($msg)
    {
        $this->errorType = 'View Error';
        parent::__construct($msg); 
    }
}