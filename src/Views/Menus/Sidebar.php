<?php

namespace Views\Menus;

use Views\View;
use Views\Buttons\MenuButton;
use Views\Buttons\Expander;

class Sidebar extends View
{

    public array $entities;
    public string $width;
   
    public function __construct(string $id, array $entities, array $attributes=[], string $width='400px')
    {
        $this->id = $id;
        $this->entities = $entities;
        $this->attributes = $attributes;
        $this->width = $width;

        $this->createSidebar();
    }

    protected function createSidebar()
    {
        $tabIndex=$GLOBALS['tabIndex'];

        $menuBuilder = new MenuBuilder();
        $menu = $menuBuilder->createMenu($this->entities, MenuButton::class, Expander::class, $tabIndex);

        $openButton = $this->build('button')
                            ->attr('id', 'sideContentButton')
                            ->attr('class', 'w3-bar-item w3-button w3-large')
                            ->attr('style', 'float:left')
                            ->attr('onclick', 'openSideBar(`mainView`, `side`, `'.$this->width.'`)')
                            ->content('&#9776')
                            ->create();

        $closeButton = $this->build('button')
                            ->attr('class', 'w3-bar-item w3-button w3-medium')
                            ->attr('onclick', 'closeSideBar(`mainView`, `side`)')
                            ->content('Close &times;')
                            ->create();

        $sidebar = $this->build('div')
                        ->attr('class', 'sidebar primaryBackground w3-container w3-bar-block w3-card w3-collapse w3-animate-left')
                        ->attr('style', 'width:'.$this->width.';')
                        ->content($closeButton . $menu)
                        ->create();

        parent::__construct($this->id, $openButton . $sidebar, $this->attributes);
    }
}

