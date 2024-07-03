<?php

namespace Views\Elements;

use Views\View;
use \config;

class Sidebar extends View
{
    public Menu $menu;
    public Element $openButton;

    public function __construct(bool $open, ...$rows)
    {
        $closeButton = new Element('button', 'Close &times;', ['class'=>'closeButton w3-bar-item w3-button w3-medium', 'onclick'=>'closeSideBar(event)']);

        $this->menu = new Menu($rows);
        // $this->menu = new Menu(Button::class, 'hcPageContent', [], Expander::class,  'hcPageContent', [], 'children', ...$rows);
        $this->menu->addAttributes(['class'=>'menu w3-container w3-bar-block', 'width'=>'300px', 'height'=>'100%', 'style'=>$open ? 'display:block;' : 'display:none;']);
        array_unshift($this->menu->elements, $closeButton);

        $this->openButton = new Element('button', '&#9776', ['class'=>'openButton w3-bar-item w3-button w3-large', 'onclick'=>"openSideBar(event)", 'width'=>'54px', 'height'=>'54px', 'style'=>'width:54px;height:54px;', 'style'=>$open ? 'display:none;' : 'display:block;']);

        parent::__construct($this->menu, $this->openButton);
        $this->addAttributes(['class'=>'sidebar w3-card-4', 'style'=>$open ? 'width:300px;height:100%' : 'width:54px;height:54px;']);
    }
}