<?php

namespace Views\Elements;


use Views\View;
use \utilities as u;

class Dropdown extends View
{
    public function __construct(Element $button, Menu $menu)
    {
        $caret = new Element('i', '', ['class'=>'fa fa-caret-down']);
        $button->before($caret->create() . '  ');

        $menu->addAttributes(['class'=>'w3-dropdown-content w3-bar-block w3-card-4']);
        foreach($menu->elements as $element)
        {
            $element->addAttributes(['class'=>'w3-bar-item']);
        }

        parent::__construct($button, $menu);

        $this->addAttributes(['class'=>'w3-dropdown-hover']);
     }

}