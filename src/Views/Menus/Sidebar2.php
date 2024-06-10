<?php

namespace Views\Menus;

use Views\View;
use Views\Layout;
use Views\Buttons\MenuButton;
use Views\Buttons\Expander;
use \utilities as u;


class Sidebar2 extends View
{
    public array $entities;
    public string $width;
    public Layout $layout;
   
    public function __construct(string $id, array $entities, array $attributes=[], string $width='400px')
    {
        $this->id = $id;
        $this->attributes = $attributes;

        $this->entities = $entities;
        $this->width = $width;
        

        // $this->extractBundle($this->entities);

        // u::dd($this->bundle['style']);

        $this->createSidebar();
    }

    protected function createSidebar()
    {
        // $tabIndex=$GLOBALS['tabIndex'];

        $openButton = new View('sideContentButton', '&#9776', ['class'=>'w3-bar-item w3-button w3-large', 'style'=>'float:left', 'onclick'=>'openSideBar(event)'], 'button');
        $closeButton = new View('sideContentButton', 'Close &times;', ['class'=>'w3-bar-item w3-button w3-medium', 'style'=>'float:left', 'onclick'=>'closeSideBar(event)'], 'button');

        array_unshift($this->entities, $closeButton);

        $this->layout = new Layout($this->id.'-layout', $this->entities, ['class'=>'primaryBackground w3-container w3-bar-block w3-card w3-collapse w3-animate-left', 'style'=>'width:'.$this->width.';
        
            font-size: small;
            height: 25em;
            padding-top: 20px;
            padding-bottom: 200px;
            border-radius: 0 10px 0 0;
            overflow: auto;
        
        ']);

        $this->addBundle($this->layout->bundle);

        parent::__construct($this->id, $openButton->create() . $this->layout->create(), $this->attributes);
    }
}