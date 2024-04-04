<?php

namespace ViewModels\Builders;

class MenuBuilder extends HtmlBuilder{

    use cssClasses;

    public $menuHtml;


    public function createSideBar($barItems) {

        if (is_array($barItems) && count($barItems) > 0){

            // internal element
            // sidebars need to have this close button at the top
            // $content = $this->buildElement('button')
            //                 ->classList($this->sbCloseBtnClasses)
            //                 ->onclick('closeSideBar()')
            //                 ->content('Close &times;')
            //                 ->create();

            $content = '';

            $i = 0;
            foreach ($barItems as $item)
            {
                
                // If there is a nested array, it is sent to create an accordian
                if (array_key_exists("menuItems", $item)) {

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
            
            // adjacent element
            $sbOpenButton = $this->buildElement('button')
                                ->id('sideContentButton')
                                ->classList($this->sbOpenBtnClasses)
                                ->style('float:left')
                                ->onclick('openSideBar()')
                                ->content('&#9776')
                                ->create();
            // ###################################

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

            $caret = $this->buildElement('i')
                        ->id($index.'-caret')
                        ->classList($this->sbITagClasses)
                        ->create();

            $acButton = $this->buildElement('button')
                            ->classList($this->sbButtonClasses)
                            ->onclick("accordian('" .$index . "');location.href='".$acLink."'")
                            ->content($caret . '   ' . $acName)
                            ->create();

            $acContainer = $this->buildElement('div')
                                ->id($index)
                                ->classList($this->sbAccordianClasses)
                                ->content($accordianAnchorTags)
                                ->create();


            return $acButton . $acContainer;
        }
        else{
            return false;
        }
    }
}
