<?php

namespace Views\Menus;

use Views\HtmlBuilder;
use Views\Defaults\SubMenuButton;
use Views\Defaults\MenuButton;

class MenuBuilder extends HTMLBuilder
{

    public function createMenu($menuItems, $buttonClass, $subMenuButtonClass, &$tabIndex=1) 
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
                    $tabIndex++;

                    $subMenu = $this->createMenu($item['child'], $buttonClass, $subMenuButtonClass, $tabIndex);

                    $subMenuButton = new $subMenuButtonClass($item['name'], $subMenu, $item['link']);

                    $menu .= $subMenuButton->create();
                }
                // else, if the item is a button build a button, this also means we are at the top level
                else if ($this->isButton($item))
                { 
                    $menuButton = new $buttonClass($item['name'], $item['link']);

                    $menu .= $menuButton->create();     
                }
                // otherwise the item retrieved doesn't fit, so log it and build a placeholder that says 'resource not found'
                else
                {
                    $menuButton = new $buttonClass($item['This resource was not found'], '');

                    $menu .= $menuButton->create();
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