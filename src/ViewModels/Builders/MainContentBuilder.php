<?php

namespace ViewModels\Builders;

class MainContentBuilder extends HtmlBuilder{

    public $mainContentClasses = "mainContent secondaryBackground w3-container";

    public $contentDivClasses = "";

    public $contentButtonClasses = "w3-button";
    public $contentAnchorClasses = "";

    public $contentImageClasses = "w3-round";
    public $contentPanelClasses = "primaryBackground w3-panel w3-card-4 w3-padding-16 w3-round-large";

    public $contentBioInfoClasses = "bioInfo w3-container";
    public $contentBioImgClasses = "bioImg w3-round";
    public $contentBioCardClasses = "bioCard w3-card-4 w3-round";

    public $content;
    public $mainContent;


    public function createMainContent($content="", $classList=""){

        $mainContent = $this->buildElement('div')
                                    ->id('mainContent')
                                    ->classList($this->mainContentClasses)
                                    ->content($content)
                                    ->create();

        return $mainContent;
    }


    public function createDivContent($content="", $id="", $style="", $tabIndex="") {

        $div = $this->buildElement('div')
                                    ->id($id)
                                    ->classList($this->mainContentClasses)
                                    ->style($style)
                                    ->tabindex($tabIndex)
                                    ->content($content)
                                    ->create();

        return $div;
    }


    public function createAnchorContent($content="", $link="", $id="", $style="", $tabIndex="") {

        $anchor = $this->buildElement('a')
                                    ->id($id)
                                    ->classList($this->mainContentClasses)
                                    ->style($style)
                                    ->href($link)
                                    ->tabindex($tabIndex)
                                    ->content($content)
                                    ->create();

        return $anchor;
    }


    public function createButtonContent($content="", $onclick="", $id="", $style="", $tabIndex="") {

        $button = $this->buildElement('button')
                                    ->id($id)
                                    ->classList($this->mainContentClasses)
                                    ->style($style)
                                    ->onclick($onclick)
                                    ->tabindex($tabIndex)
                                    ->content($content)
                                    ->create();

        
        return $button;
    }


    public function createImageCard($source="", $caption1="", $caption2="", $caption3="", $alt="Could not find image", $id="", $style="", $width="300", $height="", $tabIndex=""){

        $caption1 = '<h4><b>'.$caption1.'</b></h4>';
        $caption2 = $this->createPanelContent($caption2);
        $caption3 = $this->createPanelContent($caption3);

        $image = $this->buildElement('img')
                                    ->id($id)
                                    ->classList($this->contentBioImgClasses)
                                    ->src($source)
                                    ->alt($alt)
                                    ->width($width)
                                    ->height($height)
                                    ->tabindex($tabIndex)
                                    ->create();


        $info = $this->buildElement('div')
                                 ->classList($this->contentBioInfoClasses)
                                 ->content($caption1.$caption2.$caption3)
                                 ->create();

        
        $bioCard = $this->buildElement('div')
                        ->classList($this->contentBioCardClasses)
                        ->style('width100%; max-width:800px;')
                        ->content($image.$info)
                        ->create();

        return $bioCard;
    }


    public function createImageContent($source="", $alt="Could not find image", $id="", $style="", $width="", $height="", $tabIndex=""){

        $image = $this->buildElement('img')
            ->classList($this->contentImageClasses)
            ->src($source)
            ->alt($alt)
            ->width($width)
            ->height($height)
            ->tabindex($tabIndex)
            ->create();


        $imageContainer = $this->buildElement('div')
                               ->id($id)
                               ->classList('w3-card-4')
                               ->style('width:19%')
                               ->content($image)
                               ->create();

        return $imageContainer;
    }


    public function createPanelContent($content="", $id="", $style="", $tabIndex="") {

        $panel = $this->buildElement('p')
                             ->id($id)
                             ->classList($this->contentPanelClasses)
                             ->style($style)
                             ->tabindex($tabIndex)
                             ->content($content)
                             ->create();

        return $panel;
    }




}
