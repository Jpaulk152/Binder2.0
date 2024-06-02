<?php

namespace Views;

use Views\Includes\Includes;
use \utilities as u;

class View extends HtmlBuilder {

    public string $id = '';
    public $entity;
    public string $classes = '';
    public array $attributes = [];
    public string $method = '';

    public function __construct(string $id, $entity, array $attributes=[])
    {
        $this->id = $id;
        $this->entity = $entity;
        $this->attributes = $attributes;

        $this->element = $this->createView();
    }


    protected function createView()
    {
        $this->element = $this->build('div');
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

            case is_array($this->entity):
                return $this->element->content(print_r($this->entity, true));
                break;

            case is_a($this->entity, 'Views\Layout'):
                return $this->element->content($this->entity->element->create());
                break;

            case is_a($this->entity, 'Views\View'):
                return $this->entity->element;
                break;

            default:
                return $this->element->content('No content provided');
        }
    }

    public function create()
    {
        return $this->element->create();
    }
}