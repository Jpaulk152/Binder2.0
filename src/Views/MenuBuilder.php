<?php

namespace Views;

class MenuBuilder extends HtmlBuilder{

    public function createMenu($menuItems, $classList=[], &$tabIndex=1) 
    {

        if (is_array($menuItems) && count($menuItems) > 0)
        {
            // echo var_dump($menuItems) . '<br><br>';

            $menu = '';
            $tabIndex;
            foreach ($menuItems as $item)
            {
                
                $item = $this->menuData($item);

                // If the item is a menu build a submenu
                if ($this->isMenu($item)) 
                {
                    $i = $tabIndex;
                    $tabIndex++;

                    $subMenu = $this->createMenu($item['child'], $classList, $tabIndex);

                    $caret = $this->build('i')
                                  ->attr('id', 'menu-'. $i .'-caret')
                                  ->attr('class', 'navCaret fa fa-caret-down')
                                  ->create();

                    $subMenuButton = $this->build('button')
                                          ->attr('id', 'menu-'. $i)
                                          ->attr('class', 'navSubMenuButton w3-button')
                                          ->attr('onclick', "expand(this);location.href='" .$item['link']. "'")
                                          ->content($caret . '   ' . $item['name'])
                                          ->create();

                    $subMenu = $this->build('div')
                                    ->attr('class', 'navSubMenu w3-dropdown-content w3-bar-block w3-card-4')
                                    ->content($subMenu)
                                    ->create();

                    $subMenuContainer = $this->build('div')
                                            ->attr('class', 'navSubMenuContainer w3-dropdown-hover w3-large')
                                            ->attr('tabindex', $i)
                                            ->content($subMenuButton . $subMenu)
                                            ->create();


                    $menu .= $subMenuContainer;
                    
                }
                // else, if the item is a button build a button, this also means we are at the top level
                else if ($this->isButton($item))
                { 

                    $menuButton = $this->build('a')
                                        ->attr('class', 'navMenuButton w3-bar-item w3-button w3-large')
                                        ->attr('href', $item['link'])
                                        ->attr('tabindex', $tabIndex++)
                                        ->content($item['name'])
                                        ->create();

                    $menu .= $menuButton;
                    
                }
                // otherwise the item retrieved doesn't fit, so log it and build a placeholder that says 'resource not found'
                else
                {

                    $menuButton = $this->build('a')
                                    ->attr('class', 'navMenuButton w3-bar-item w3-button w3-large')
                                    ->attr('href', '#')
                                    ->attr('tabindex', $tabIndex++)
                                    ->content('This resource was not found')
                                    ->create();

                     $menu .= $menuButton;
                }

                // $tabIndex++;
            }

            return $menu;

        }
        else
        {
            return false;
        }
    }


    public function isMenu($item)
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


    public function isButton($item)
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


    public function menuData($item)
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