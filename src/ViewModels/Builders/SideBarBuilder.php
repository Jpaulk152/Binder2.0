<?php

namespace ViewModels\Builders;

class SideBarBuilder extends HtmlBuilder{

    public $sbContainerClasses = "sideContent primaryBackground w3-container w3-sidebar w3-border w3-bar-block w3-collapse w3-animate-left w3-card";
    // public $sbContainerClasses = "sideContent primaryBackground w3-container w3-sidebar w3-border w3-bar-block w3-animate-left w3-card";
    public $sbButtonClasses = "sideButton secondaryBackground w3-button w3-block w3-border w3-card-4";
    public $sbAnchorClasses = "w3-bar-item";

    public $sbAnchorContainerClasses = "w3-hide w3-animate-zoom w3-animate-top";
    public $sbAccordianClasses = "primaryBackground w3-hide w3-animate-zoom accordian";
    public $sbITagClasses = "fa fa-caret-right caret";
    public $sbCloseBtnClasses = "w3-bar-item w3-button w3-hide-large";
    public $sbOpenBtnClasses = "w3-button w3-xlarge w3-hide-large";


    public $sideBar;


    public function createSideBar($barItems) {

        if (is_array($barItems) && count($barItems) > 0){

            $content = $this->buildElement('button')
                            ->classList($this->sbCloseBtnClasses)
                            ->onclick('closeSideBar()')
                            ->content('Close &times;')
                            ->create();

            $i = 0;
            foreach ($barItems as $item)
            {
                
                // If there is a nested array, it is sent to create an accordian
                if (array_key_exists("menuItems", $item)) {

                    // // If the current item is not an error there is a problem : FIX THIS LATER
                    // if($item["menuItems"] == false){
                    //     $anchor = $this->buildElement('a')
                    //                 ->classList($this->sbAnchorClasses)
                    //                 ->href('#')
                    //                 ->tabindex($i)
                    //                 ->content('This resource was not found')
                    //                 ->create();

                    //     $content .= $anchor;
                    // }
                    // else
                    // {

                    //     $accordian = $this->createAccordian($item["name"], $item["link"], $item["menuItems"], "accordian-".$i);
                    //     $content .= $accordian;
                    // }
                    
                    $accordian = $this->createAccordian($item["name"], $item["link"], $item["menuItems"], "accordian-".$i);
                    $content .= $accordian;
                    
                }
                else { // else the item becomes an anchor tag, this also means we are at the top level

                    $anchorTag = $this->buildElement('a')
                                    ->classList($this->sbAnchorClasses)
                                    ->href($item['link'])
                                    ->tabindex($i)
                                    ->content($item['name'])
                                    ->create();


                    $content .= $anchorTag;
                    
                }
                $i++;
            }
            
            $sbOpenButton = $this->buildElement('button')
                                ->id('sideContentButton')
                                ->classList($this->sbOpenBtnClasses)
                                ->style('float:left')
                                ->onclick('openSideBar()')
                                ->content('&#9776')
                                ->create();

            $sbContainer = $this->buildElement('div')
                                ->id('sideContent')
                                ->classList($this->sbContainerClasses)
                                ->content($content)
                                ->create();

            return $sbOpenButton . $sbContainer;
        }
        else {
            return false;
        }
    
    }


    public function createAccordian($acName, $acLink, $acItems, $index) {
        if (count($acItems) > 0){

            $accordianAnchorTags = "";



            for ($i = 0; $i < count($acItems); $i++){

                // If the current item is not an error there is a problem
                if(!is_array($acItems[$i])){
                    $anchor = $this->buildElement('a')
                                ->classList($this->sbAnchorClasses)
                                ->href('#')
                                ->tabindex($i)
                                ->content('This resource was not found')
                                ->create();

                    $accordianAnchorTags .= $anchor;
                }

                // If there is a nested array, it is sent to create an accordian
                else if (array_key_exists("menuItems", $acItems[$i])) {

                    $accordian = $this->createAccordian($acItems[$i]["name"], $acItems[$i]["link"], $acItems[$i]["menuItems"], $index.'-'.$i);
                    $accordianAnchorTags .= $accordian;

                }
                else { // else the item becomes an anchor tag

                    
                    // EDIT LATER: this id here will just be from the iteration number
                    $anchor = $this->buildElement('a')
                                ->classList($this->sbAnchorClasses)
                                ->href($acItems[$i]['link'])
                                ->tabindex($i)
                                ->content($acItems[$i]['name'])
                                ->create();


                    $accordianAnchorTags .= $anchor;

                }

            }

            // $caret = $this->buildElement('i')
            //             ->id($index.'-caret')
            //             ->classList($this->sbITagClasses)
            //             ->create();

            // $acButton = $this->buildElement('button')
            //                 ->classList($this->sbButtonClasses)
            //                 ->onclick("accordian('" .$index . "');location.href='".$acLink."'")
            //                 ->content($caret . '   ' . $acName)
            //                 ->create();

            // $acContainer = $this->buildElement('div')
            //                     ->id($index)
            //                     ->classList($this->sbAccordianClasses)
            //                     ->content($accordianAnchorTags)
            //                     ->create();


            // return $acButton . $acContainer;

            $caret = $this->buildElement('i')
            ->id($index.'-caret')
            ->classList($this->sbITagClasses)
            ->create();

            $acButton = $this->buildElement('button')
                            ->classList($this->sbButtonClasses)
                            ->onclick("accordian('" .$index . "');location.href='".$acLink."'")
                            ->content($caret . '   ' . $acName)
                            ->create();

            $accordian = $this->buildElement('div')
                                ->id($index)
                                ->classList($this->sbAccordianClasses)
                                ->content($accordianAnchorTags)
                                ->create();


            $acContainer = $this->buildElement('div')
            ->classList('thingContainter')
            ->content($acButton . $accordian)
            ->create();

            return $acContainer;

        }
        else{
            return false;
        }
    }
}
