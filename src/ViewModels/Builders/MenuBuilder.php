<?php

namespace ViewModels\Builders;

class MenuBuilder extends HtmlBuilder{

    public function createMenu($menuItems, $classList=[], $expandFunction='', $internalElements=[], $adjacentElements=[], $tabIndex=0) {
        if (is_array($menuItems) && count($menuItems) > 0){

            // echo var_dump($menuItems) . '<br><br>';

            
            $menu = '';
            $i = $tabIndex;
            foreach ($menuItems as $item)
            {
                
                // If the item is a menu build a submenu
                if ($this->isMenu($item)) {

                    $subMenu = $this->createMenu($item['submenu'], $classList, $expandFunction, $internalElements, $adjacentElements, $tabIndex);

                    $caret = $this->buildElement('i')
                                  ->id('menu-'. $i .'-caret')
                                  ->classList($classList['caret'])
                                  ->create();

                    $subMenuButton = $this->buildElement('button')
                                          ->id('menu-'. $i)
                                          ->classList($classList['subMenuButton'])
                                          ->onclick("expand(this);location.href='" .$item['link']. "'")
                                          ->content($caret . '   ' . $item['name'])
                                          ->create();

                    $subMenu = $this->buildElement('div')
                                     ->classList($classList['subMenu'])
                                     ->content($subMenu)
                                     ->create();

                    $subMenuContainer = $this->buildElement('div')
                                            ->classList($classList['subMenuContainer'])
                                            ->tabindex($tabIndex+1)
                                            ->content($subMenuButton . $subMenu)
                                            ->create();


                    $menu .= $subMenuContainer;
                    
                }
                // else, if the item is a button build a button, this also means we are at the top level
                else if ($this->isButton($item))
                { 

                    $menuButton = $this->buildElement('a')
                                    ->classList($classList['menuButton'])
                                    ->href($item['link'])
                                    ->tabindex($tabIndex+1)
                                    ->content($item['name'])
                                    ->create();


                    $menu .= $menuButton;
                    
                }
                // otherwise the item retrieved doesn't fit, so log it and build a placeholder that says 'resource not found'
                else
                {

                    $menuButton = $this->buildElement('a')
                                    ->classList($classList['menuButton'])
                                    ->href('#')
                                    ->tabindex($tabIndex+1)
                                    ->content('This resource was not found')
                                    ->create();

                     $menu .= $menuButton;
                }

                $i++;
            }

            return $menu;

        }
        else{
            return false;
        }
    }


    public function isMenu($item)
    {
        if(is_array($item) && array_key_exists('name', $item) && array_key_exists('link', $item) && array_key_exists('submenu', $item) && is_array($item['submenu']) && count($item['submenu']) > 0)
        {
            return true;
        }
        else
        {
           
            // \utilities::consoleLog('Item is not a menu: ', $item);
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
            
            // \utilities::consoleLog('Item is not a button', $item);
            return false;
        }
    }

}