<?php

namespace Views;

use \utilities as u;
use Views\Layout;

class View extends HtmlBuilder {

    public string $id = '';
    public $entity;
    public string $classes = '';
    public array $attributes = [];
    public string $tagName;

    public array $css;
    public array $js;

    public array $bundle;

    public string $method = '';

    public function __construct(string $id, $entity, array $attributes=[], string $tagName='div')
    {
        $this->id = $id;
        $this->entity = $entity;
        $this->attributes = $attributes;
        $this->tagName = $tagName;

        if (!isset($this->bundle))
        {
            $this->bundle = [];
        }

        $this->element = $this->createView();

        // echo $this->create();
    }

    protected function createView()
    {
        $this->element = $this->build($this->tagName);
        $this->element->attr('id', $this->id);

        foreach ($this->attributes as $attribute => $value)
        {
            $this->element->attr($attribute, $value);
        }

        switch($this->entity) 
        {
            case is_string($this->entity):
                return $this->element->content($this->entity);
                break;

            case is_array($this->entity) || is_object($this->entity):
                return $this->element->content(print_r($this->entity, true));
                break;

            case is_a($this->entity, Layout::class):
                $this->addBundle($this->entity->bundle);
                return $this->element->content($this->entity->element->create());
                break;

            case is_a($this->entity, View::class):
                return $this->entity->element;
                break;

            default:
                return $this->element->content('No content provided');
        }
    }

    protected function addBundle(array $bundle)
    {
        foreach ($bundle as $name => $set)
        {
            if (!isset($this->bundle[$name]))
            {
                $this->bundle[$name] = $set;
            }
            else
            {
                $this->bundle[$name] = array_unique(array_merge($this->bundle[$name], $set));
            }
        }
    }

    public function create()
    {
        return $this->element->create();
    }

    public function getBundle(string $name)
    {
        if(isset($this->bundle[$name]))
        {
            $set = '<'.$name.'>';
            foreach($this->bundle[$name] as $item)
            {
                $set .= $item;
            }
            $set .= '</'.$name.'>';

            return $set;
        }
        return false;
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