<?php

namespace ViewModels\Builders;

class MenuBuilder extends HtmlBuilder{

    use cssClasses;

    public $menuHtml;

    public function createMenu($menuItems) {

        if (is_array($menuItems) && count($menuItems) > 0){

            $menu = '';

            $i = 0;
            foreach ($menuItems as $item)
            {
                
                // If there is a nested array, it is sent to create an accordian
                if (array_key_exists("menuItems", $item)) {

                    $subMenu = $this->createSubMenu($item["name"], $item["link"], $item["menuItems"], "subMenu-".$i);
                    $menu .= $subMenu;
                    
                }
                else { // else the item becomes a button, this also means we are at the top level

                    $button = $this->buildElement('a')
                                    ->classList($this->sbAnchorClasses)
                                    ->href($item['link'])
                                    ->tabindex($i)
                                    ->content($item['name'])
                                    ->create();


                    $menu .= $button;
                    
                }
                $i++;
            }
            

            // adjacent element for sidebar (rendered to the left or right using return)
            $sbOpenButton = $this->buildElement('button')
                                 ->id('sideContentButton')
                                 ->classList($this->sbOpenBtnClasses)
                                 ->style('float:left')
                                 ->onclick('openSideBar()')
                                 ->content('&#9776')
                                 ->create();
            // ###################################

            // internal element for sidebar (rendered to the left or right of menu inside container)
            $sbCloseButton = $this->buildElement('button')
                            ->classList($this->sbCloseBtnClasses)
                            ->onclick('closeSideBar()')
                            ->content('Close &times;')
                            ->create();
            // ###################################


            $sbContainer = $this->buildElement('div')
                                ->id('sideContent')
                                ->classList($this->sbContainerClasses)
                                ->content($sbCloseButton . $menu)
                                ->create();

            return $sbOpenButton . $sbContainer;
        }
        else {
            return false;
        }
    
    }


    public function createSubMenu($menuName, $menuLink, $menuItems, $index) {
        if (is_array($menuItems) && count($menuItems) > 0){

            $menu = '';

            for ($i = 0; $i < count($menuItems); $i++){

                // If the current item is not an error there is a problem
                if(!is_array($menuItems[$i])){

                    $button = $this->buildElement('a')
                                ->classList($this->sbAnchorClasses)
                                ->href('#')
                                ->tabindex($i)
                                ->content('This resource was not found')
                                ->create();

                    $menu .= $button;
                }

                // If there is a nested array, it is sent to create an accordian
                else if (array_key_exists("menuItems", $menuItems[$i])) {

                    $subMenu = $this->createSubMenu($menuItems[$i]["name"], $menuItems[$i]["link"], $menuItems[$i]["menuItems"], $index.'-'.$i);
                    $menu .= $subMenu;

                }
                else { // else the item becomes an anchor tag

                    
                    // EDIT LATER: this id here will just be from the iteration number
                    $anchor = $this->buildElement('a')
                                ->classList($this->sbAnchorClasses)
                                ->href($menuItems[$i]['link'])
                                ->tabindex($i)
                                ->content($menuItems[$i]['name'])
                                ->create();


                    $menu .= $anchor;

                }

            }


            $caret = $this->buildElement('i')
                          ->id($index.'-caret')
                          ->classList($this->sbITagClasses)
                          ->create();

            $subMenuButton = $this->buildElement('button')
                            ->classList($this->sbButtonClasses)
                            ->onclick("accordian('" .$index . "');location.href='".$menuLink."'")
                            ->content($caret . '   ' . $menuName)
                            ->create();

            $subMenu = $this->buildElement('div')
                                ->id($index)
                                ->classList($this->sbAccordianClasses)
                                ->content($menu)
                                ->create();


            $subMenuContainer = $this->buildElement('div')
            ->classList('subMenuContainer')
            ->content($subMenuButton . $subMenu)
            ->create();

            return $subMenuContainer;

        }
        else{
            return false;
        }
    }

}


