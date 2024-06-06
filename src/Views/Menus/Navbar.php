<?php

namespace Views\Menus;

use Views\View;
use Views\Layout;
use Views\Buttons\MenuButton;
use Views\Buttons\Dropdown;
use Views\Includes\Includes;

class Navbar extends View
{
    public array $entities;

    public function __construct(string $id, array $entities, array $attributes=[])
    {
        $this->id = $id;
        $this->entities = $entities;
        $this->attributes = $attributes;

        $this->extractBundle($this->entities);
        $this->createNavbar();
    }


    protected function createNavbar()
    {
        $tabIndex = $GLOBALS['tabIndex'];

        $menuBuilder = new MenuBuilder();
        $menu = $menuBuilder->createMenu($this->entities, MenuButton::class, Dropdown::class, $tabIndex);
        
        $logo = $this->build('img')
                    ->attr('src', Includes::path('logo'))
                    ->attr('alt', 'Could not find Image')
                    ->attr('width', '70')
                    ->attr('height', '70')
                    ->create();

        $homeButton = $this->build('a')
                            ->attr('class', 'w3-bar-item w3-button w3-large')
                            ->attr('href', '../index.php/home')
                            ->content($logo)
                            ->create();

        parent::__construct($this->id, $homeButton . $menu, $this->attributes);
    }


    protected function extractBundle(array $entities)
    {
        foreach($entities as $entity)
        {
            foreach($entity as $name=>$field)
            {
                if (is_a($field, View::class) || is_a($field, Layout::class))
                {
                    $this->addBundle($field->bundle);
                }

                if ($name == 'children')
                {
                    $this->extractBundle($field);
                }
            }
        }
    }
}

