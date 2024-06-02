<?php

namespace Views\Menus;

use Views\View;
use Views\Defaults\MenuButton;
use Views\Defaults\ExpandButton;

class Sidebar extends View
{

    public array $entities;
   
    public function __construct(string $id, array $entities, array $attributes=[])
    {
        $this->id = $id;
        $this->entities = $entities;
        $this->attributes = $attributes;

        $this->createSidebar();
    }

    protected function createSidebar()
    {
        $tabIndex=$GLOBALS['tabIndex'];

        $menuBuilder = new MenuBuilder();
        $menu = $menuBuilder->createMenu($this->entities, MenuButton::class, ExpandButton::class, $tabIndex);

        $openButton = $this->build('button')
                            ->attr('id', 'sideContentButton')
                            ->attr('class', 'w3-bar-item w3-button w3-large')
                            ->attr('style', 'float:left')
                            ->attr('onclick', 'openSideBar(`mainView`, `side`, `400px`)')
                            ->content('&#9776')
                            ->create();

        $closeButton = $this->build('button')
                            ->attr('class', 'w3-bar-item w3-button w3-medium')
                            ->attr('onclick', 'closeSideBar(`mainView`, `side`)')
                            ->content('Close &times;')
                            ->create();

        $sidebar = $this->build('div')
                        ->attr('class', 'sidebar primaryBackground w3-container w3-bar-block w3-card w3-collapse w3-animate-left')
                        ->content($closeButton . $menu)
                        ->create();

        parent::__construct($this->id, $openButton . $sidebar, $this->attributes);
    }
}

