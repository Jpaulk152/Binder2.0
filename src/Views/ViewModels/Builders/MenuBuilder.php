<?php

namespace Views\ViewModels\Builders;

class MenuBuilder extends HtmlBuilder{

    public function createMenu($menuItems, $classList=[], &$tabIndex=1, $itemTitle='name', $itemLink='link') 
    {

        if (is_array($menuItems) && count($menuItems) > 0)
        {
            // echo var_dump($menuItems) . '<br><br>';

            $menu = '';
            $tabIndex;
            foreach ($menuItems as $item)
            {
                
                $item = $this->menuData($item, $itemTitle, $itemLink);

                // If the item is a menu build a submenu
                if ($this->isMenu($item)) 
                {



                    $i = $tabIndex;
                    $tabIndex++;

                    $subMenu = $this->createMenu($item['child'], $classList, $tabIndex, $itemTitle, $itemLink);

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
                                            ->tabindex($i)
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
                                    ->tabindex($tabIndex++)
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
                                    ->tabindex($tabIndex++)
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


    public function menuData($item, $itemTitle, $itemLink)
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