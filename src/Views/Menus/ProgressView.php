<?php

namespace Views\Menus;

use Views\Includes\Includes;
use Views\View;

class ProgressView extends View
{
    public array $classLists = 
    [
        'HCDefault' =>
        [
            'caret' => 'navCaret fa fa-caret-down',
            'subMenuButton' => 'navSubMenuButton w3-button',
            'subMenu' => 'navSubMenu w3-dropdown-content w3-bar-block w3-card-4',
            'subMenuContainer' => 'navSubMenuContainer w3-dropdown-hover w3-large',
            'menuButton' => 'navMenuButton w3-bar-item w3-button w3-large',
            'logo' => 'navLogo',
            'homeButton' => 'navLogoContainer w3-bar-item w3-button w3-large',
            'navContainer' => 'navMenuContainer secondaryBackground w3-bar w3-card-4'
            
        ],

        'Default' =>
        [
            'caret' => 'navCaret fa fa-caret-down',
            'subMenuButton' => 'navSubMenuButton w3-button',
            'subMenu' => 'navSubMenu w3-grey w3-dropdown-content w3-bar-block w3-card-4',
            'subMenuContainer' => 'navSubMenuContainer w3-dropdown-hover w3-large',
            'menuButton' => 'navMenuButton w3-bar-item w3-button w3-large',
            'logo' => 'navLogo',
            'homeButton' => 'navLogoContainer w3-bar-item w3-button w3-large',
            'navContainer' => 'navMenuContainer w3-black w3-bar w3-card-4'
        ]
    ];

    public function __construct(array $entities, string $type='Default')
    {
        $this->cssBundle = '';
        $this->jsBundle = '';

        $tabIndex=$GLOBALS['tabIndex'];

        $menu = $this->createMenu($entities, $this->classLists[$type], $tabIndex);
        
        $logo = $this->build('img')
                    ->attr('class', $this->classLists[$type]['logo'])
                    ->attr('src', '../resources/logo.png')
                    ->attr('alt', 'Could not find Image')
                    ->attr('width', '70')
                    ->attr('height', '70')
                    ->create();

        $homeButton = $this->build('a')
                            ->attr('class', $this->classLists[$type]['homeButton'])
                            ->attr('href', '../index.php/home')
                            ->content($logo)
                            ->create();

        $navBar = $this->build('nav')
                ->attr('class', $this->classLists[$type]['navContainer'])
                ->content($homeButton . $menu);

        $this->element = $navBar;
    }



    
    public function createMenu($menuItems, $classList, &$tabIndex=1) 
    {
        if (is_array($menuItems) && count($menuItems) > 0)
        {
            $menu = '';            
            foreach ($menuItems as $item)
            {
                $item = $this->menuData($item);

                // If the item is a menu build a submenu
                if ($this->isMenu($item)) 
                {
                    $i = $tabIndex;
                    $tabIndex++;

                    $subMenu =                  $this->createMenu($item['child'], $classList, $tabIndex);

                    $caret =                    $this->build('i')
                                                    ->attr('class', $classList['caret'])
                                                    ->create();

                    $subMenuButton =            $this->build('button')
                                                    ->attr('class', $classList['subMenuButton'])
                                                    ->attr('onclick', "expand(this);location.href='" .$item['link']. "'")
                                                    ->attr('tabindex', $tabIndex++)
                                                    ->content($caret . '   ' . $item['name'])
                                                    ->create();

                    $subMenu =                  $this->build('div')
                                                    ->attr('class', $classList['subMenu'])
                                                    ->content($subMenu)
                                                    ->create();

                    $subMenuContainer =         $this->build('div')
                                                    ->attr('class', $classList['subMenuContainer'])
                                                    ->content($subMenuButton . $subMenu)
                                                    ->create();


                    $menu .= $subMenuContainer;
                    
                }
                // else, if the item is a button build a button, this also means we are at the top level
                else if ($this->isButton($item))
                { 

                    $menuButton =               $this->build('a')
                                                    ->attr('class', $classList['menuButton'])
                                                    ->attr('href', $item['link'])
                                                    ->attr('tabindex', $tabIndex++)
                                                    ->content($item['name'])
                                                    ->create();

                    $menu .= $menuButton;
                    
                }
                // otherwise the item retrieved doesn't fit, so log it and build a placeholder that says 'resource not found'
                else
                {

                    $menuButton =               $this->build('a')
                                                    ->attr('class', $classList['menuButton'])
                                                    ->attr('href', '#')
                                                    ->attr('tabindex', $tabIndex++)
                                                    ->content('This resource was not found')
                                                    ->create();

                        $menu .= $menuButton;
                }
            }

            return $menu;

        }
        else
        {
            return false;
        }
    }



    function isMenu($item)
    {
        if(is_array($item) && array_key_exists('name', $item) && array_key_exists('link', $item) && array_key_exists('child', $item) && is_array($item['child']) && count($item['child']) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    function isButton($item)
    {
        if(is_array($item) && array_key_exists('name', $item) && array_key_exists('link', $item))
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    function menuData($item)
    {
        // die(var_dump($item));

        if(!$item)
        {
            throw new \Exception('Error in menuData function: no $item passed');
        }

        $itemArray = array_values((array)$item);

        $menuItem['name'] = $itemArray[0];
        $menuItem['link'] = $itemArray[1];


        if(isset($item->children))
        {
            $menuItem['child'] = $item->children;
        }
        

        return $menuItem;

    }
 
}

