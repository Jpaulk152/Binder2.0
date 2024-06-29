<?php

namespace Views\Elements;

use Views\ViewError;

use \utilities as u;

class Element
{
    public string $tagName = '';
    public string $tagType = '';
    public array $attributes = [];
    public string $content = '';
    public bool $disabled = false;

    public function __construct(string $tagName='div', string $content='', ...$attributes)
    {
        $this->setTagName($tagName);
        $this->content = $content;
        $this->addAttributes(...$attributes);
    }

    public function setTagName(string $tagName) : Element
    {
        $this->tagName = $tagName;
        if($tagName == 'br' ||  $tagName == 'img' || $tagName == 'input')
        {
            $this->tagType = 'empty';
        }
        else
        {
            $this->tagType = 'container';
        }

        return $this;
    }

    public function content(string $content) : Element
    {
        if ($this->tagType == 'empty')
        {
            new ViewError('Elements with Empty (non-container) Tags may not be passed content.');
        }

        $this->content .= $content;

        return $this;
    }

    public function before(string $content) : Element
    {
        $this->content = $content . $this->content;

        return $this;
    }

    
    public function after(string $content) : Element
    {
        $this->content = $this->content . $content;

        return $this;
    }


    // $_SESSION[$name] .= !str_contains($_SESSION[$name], $value) ? $value : '';

    public function attr(string $attribute, string $value) : Element
    {

        
        if (!empty($attribute) && !empty($value))
        {
            if (array_key_exists($attribute, $this->attributes))
            {
                $this->attributes[$attribute] =  substr_replace($this->attributes[$attribute], ' '.$value, -1, 0);
            }
            else
            {
                $this->attributes[$attribute] =  $attribute.'="'.$value.'"';
            }
        }

        return $this;
    }

    public function disabled(bool $disabled = true)
    {
        $this->disabled = $disabled;
    }

    public function create() : string
    {
        $element = '';
        switch($this->tagType)
        {
            case 'container':
                $element = '<' . $this->tagName . ' ' . implode(' ', $this->attributes) . ($this->disabled ? 'disabled' : '') .'>' . $this->content . '</' . $this->tagName . '>';
                break;
            case 'empty':
                $element = '<' . $this->tagName . ' ' . implode(' ', $this->attributes) . ($this->disabled ? 'disabled' : '') .'/>';
                break;
            default:
                new ViewError('Element created without proper tagType.');
                break;
        }

        return $element;
    }


    public function addAttributes(...$arrays)
    {
        foreach ($arrays as $attributes)
        {
            foreach($attributes as $attribute=>$value)
            {
                $this->attr($attribute, $value);
            }
        }
    }

    function toJSON($input)
    {
        return htmlspecialchars(json_encode($input), ENT_QUOTES, 'UTF-8');
    }

}

