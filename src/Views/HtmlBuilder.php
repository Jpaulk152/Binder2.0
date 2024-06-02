<?php

namespace Views;

use Views\ViewError;
use \utilities as u;

class HtmlBuilder {

    public Element $element;
    
    public function build(string $elementName){

        if($elementName == 'br' ||  $elementName == 'img' || $elementName == 'input')
        {
            $tagType = 'empty';
        }
        else
        {
            $tagType = 'container';
        }
        
        return new Element($tagType, $elementName);
    }

}


class Element
{
    public string $name;
    public array $attributes;
    public string $content;
    public bool $disabled = false;
    
    public string $tagType;

    public function __construct(string $tagType, string $name)
    {
        $this->name = $name;
        $this->attributes = [];
        $this->content = '';

        $this->tagType = $tagType;

        return $this;
    }

    public function content($content)
    {
        if ($this->tagType == 'empty')
        {
            new ViewError('Elements with Empty (non-container) Tags may not be passed content.');
        }

        $this->content = $content;

        return $this;
    }

    public function attr($attribute, $value)
    {
        if (!empty($attribute) && !empty($value))
        {
            array_push($this->attributes, $attribute.'="'.$value.'"');
        }

        return $this;
    }

    public function disabled($disabled = true)
    {
        $this->disabled = $disabled;
    }

    public function create()
    {

        switch($this->tagType)
        {
            case 'container':
                $element = '<' . $this->name . ' ' . implode(' ', $this->attributes) . ($this->disabled ? 'disabled' : '') .'>' . $this->content . '</' . $this->name . '>';
                break;
            case 'empty':
                $element = '<' . $this->name . ' ' . implode(' ', $this->attributes) . ($this->disabled ? 'disabled' : '') .'/>';
                break;
            default:
                new ViewError('Element created without proper tagType.');
                break;
        }

        return $element;
    }
}

