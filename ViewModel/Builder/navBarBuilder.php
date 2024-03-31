<?php

class navBarBuilder extends htmlBuilder{

    public $navContainerClasses = "navBar secondaryBackground w3-bar w3-card-4";
    public $navLogoClasses = "";
    public $navLogoAnchorClasses = "w3-bar-item w3-button w3-large";
    public $navAnchorClasses = "navButton w3-bar-item w3-button w3-large";

    public $ddContainerClasses = "navButton w3-dropdown-hover w3-large";
    public $ddITagClasses = "fa fa-caret-down";
    public $ddButtonClasses = "w3-button";
    public $ddContentClasses = "dropdownContent w3-dropdown-content w3-bar-block w3-card-4";
    public $ddAnchorClasses = "w3-bar-item w3-button";

    public $navBar;

    public function createNavBar($barItems, $logoSource) {

        if (count($barItems) > 0){

            $content = "";

            foreach ($barItems as $item)
            {

                // If there is a nested array, it is sent to create a dropdown
                if (array_key_exists("menuItems", $item)) {

                    $dropDown = $this->createDropdown($item["name"], $item["link"], $item["menuItems"]);
                    $content .= $dropDown;
        
                }
                else { // else the item becomes an anchor tag

                    $anchor = $this->buildElement('a')
                                   ->classList($this->navAnchorClasses)
                                   ->href($item["link"])
                                   ->content($item["name"])
                                   ->create();

                                   
                    $content .= $anchor;

                }
            }

            $logo = $this->buildElement('img')
                         ->classList($this->navLogoClasses)
                         ->src($logoSource)
                         ->alt('Could not find Image')
                         ->width('70')
                         ->height('70')
                         ->create();

            $homeAnchor = $this->buildElement('a')
                               ->classList($this->navLogoAnchorClasses)
                               ->href($barItems[0]['link'])
                               ->content($logo)
                               ->create();

            $navContainer = $this->buildElement('div')
                                 ->classList($this->navContainerClasses)
                                 ->content($homeAnchor.$content)
                                 ->create();


            return $navContainer;

        }
        else{
            return false;
        }
    }


    public function createDropdown($ddName, $ddLink, $ddItems) {
        if (count($ddItems) > 0){

            $ddAnchorTags = "";

            for ($i = 0; $i < count($ddItems); $i++){

                // If there is a nested array, it is sent to create a dropdown
                if (array_key_exists("menuItems", $ddItems[$i])) {

                    $dropDown = $this->createDropdown($ddItems[$i]["name"], $ddItems[$i]["link"], $ddItems[$i]["menuItems"]);
                    $ddAnchorTags .= $dropDown;

                }
                else { // else the item becomes an anchor tag

                    $anchor = $this->buildElement('a')
                        ->classList($this->ddAnchorClasses)
                        ->href($ddItems[$i]['link'])
                        ->content($ddItems[$i]['name'])
                        ->create();

                    $ddAnchorTags .= $anchor;

                }
            }

            $ddContent = $this->buildElement('div')
                              ->classList($this->ddContentClasses)
                              ->content($ddAnchorTags)
                              ->create();

            $caret = $this->buildElement('i')
                          ->classList($this->ddITagClasses)
                          ->create();

            $ddButton = $this->buildElement('button')
                             ->classList($this->ddButtonClasses)
                             ->onclick("location.href='". $ddLink ."'")
                             ->content($ddName . " " . $caret)
                             ->create();
                             
            $ddContainer = $this->buildElement('div')
                                ->classList($this->ddContainerClasses)
                                ->content($ddButton.$ddContent)
                                ->create();


            return $ddContainer;
        }
        else{
            return false;
        }
    }

}
