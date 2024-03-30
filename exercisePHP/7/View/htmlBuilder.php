<?php

include $_SERVER['DOCUMENT_ROOT']."/exercisePHP/7/Model/general.php";
include $_SERVER['DOCUMENT_ROOT']."/exercisePHP/7/"."traits.php";

class htmlBuilder {

    // $id="", $class="", $style="", $content="", $link="", $onclick=""
    public function createDiv($id="", $class="", $style="", $content="", $tabIndex="") {
        return '<div id="'.$id.'"class="'.$class.'" style="'.$style.'" tabindex="'.$tabIndex.'">'.$content.'</div>';
    }

    public function createAnchor($id="", $class="", $style="", $content="", $link="", $tabIndex="") {
        return '<a id="'.$id.'" class="'.$class.'" style="'.$style.'" href="'.$link.'" tabindex="'.$tabIndex.'">'.$content.'</a>';
    }

    public function createButton($id="", $class="", $style="", $content="", $onclick="", $tabIndex="") {
        return '<button id="'.$id.'" class="'.$class.'" style="'.$style.'"  onclick="'.$onclick.'" tabindex="'.$tabIndex.'">'.$content.'</button>';
    }

    public function createImage($id="", $class="", $style="", $source="", $alt="", $width="", $height = "", $tabIndex=""){
        return '<img id="'.$id.'" class="'.$class.'" style="'.$style.'" src="'.$source.'" alt="'.$alt.'" width="'.$width.'" height="'.$height.'" tabindex="'.$tabIndex.'">';
    }

    public function createITag($id="", $class="", $style="") {
        return '<i id="'.$id.'" class="'.$class.'" style="'.$style.'"></i>';
    }

    public function createPTag($id="", $class="", $style="", $content="", $tabIndex="") {
        return '<div id="'.$id.'"class="'.$class.'" style="'.$style.'" tabindex="'.$tabIndex.'">'.$content.'</div>';
    }

}

class navBuilder extends htmlBuilder{

    use colors;
    use navStyles;
    use navBarTest;

    public $navBar;

    public function createNavBar($barItems) {

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

                    $anchor = $this->createAnchor("", $this->navAnchorClasses, "", $item["name"], $item["link"]);
                    $content .= $anchor;

                }
            }

            $logo = $this->createImage("", $this->navLogoClasses, "", "resources/logo.png", "Could not find Image", "70", "70");

            $homeAnchor = $this->createAnchor("", $this->navLogoAnchorClasses, "", $logo, "javascript:home()");

            $navContainer = $this->createDiv("", $this->navContainerClasses, "", $homeAnchor . $content);

        }
        return $navContainer;
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

                    $anchor = $this->createAnchor("", $this->ddAnchorClasses, "", $ddItems[$i]["name"], $ddItems[$i]["link"]);
                    $ddAnchorTags .= $anchor;

                }
            }

            $ddContent = $this->createDiv("", $this->ddContentClasses, "", $ddAnchorTags);

            $caret =  $this->createITag("", $this->ddITagClasses, "");
            
            $ddButton = $this->createButton("", $this->ddButtonClasses, "", $ddName . " " . $caret, "location.href='". $ddLink ."'");
            
            $ddContainer = $this->createDiv("", $this->ddContainerClasses, "", $ddButton . $ddContent);

        }

        return $ddContainer;
    }

}

class sbBuilder extends htmlBuilder{

    use colors;
    use sbStyles;
    use sideBarTest;

    public $sideBar;


    public function createSideBar($barItems) {

        if (count($barItems) > 0){

            $content = $this->createButton("", $this->sbCloseBtnClasses, "", "Close &times;", "w3_close()");
            $i = 0;
            foreach ($barItems as $item)
            {
                
                // If there is a nested array, it is sent to create an accordian
                if (array_key_exists("menuItems", $item)) {

                    $accordian = $this->createAccordian($item["name"], $item["link"], $item["menuItems"], "accordian-".$i);
                    $content .= $accordian;
                    
                }
                else { // else the item becomes an anchor tag, this also means we are at the top level

                    $anchorTags = $this->createAnchor("", $this->sbAnchorClasses, "", $item["name"], $item["link"], $i);
                    $content .= $anchorTags;
                    
                }
                $i++;
            }
            
            $sbOpenButton = $this->createButton("sideContentButton", $this->sbOpenBtnClasses, "float: left", "&#9776;", "w3_open()");
            $sbContainer = $this->createDiv("sideContent", $this->sbContainerClasses, "", $content);

        }
        return $sbOpenButton . $sbContainer;
    }


    public function createAccordian($acName, $acLink, $acItems, $index) {
        if (count($acItems) > 0){

            $accordianAnchorTags = "";

            for ($i = 0; $i < count($acItems); $i++){

                // general::printInfo("For name: ".$acName.", item ".$i.": ".$acItems[$i]["name"]." menuItems: " . array_key_exists("menuItems", $acItems[$i]));

                // If there is a nested array, it is sent to create an accordian

                // general::printInfo("Name: " . $acItems[$i]["name"] . ", Index:  ".$index);

                if (array_key_exists("menuItems", $acItems[$i])) {

                    $accordian = $this->createAccordian($acItems[$i]["name"], $acItems[$i]["link"], $acItems[$i]["menuItems"], $index.'-'.$i);
                    $accordianAnchorTags .= $accordian;

                }
                else { // else the item becomes an anchor tag

                    

                    // // EDIT LATER: this id here will just be from the iteration number
                    $anchor = $this->createAnchor("", $this->sbAnchorClasses, "",  $acItems[$i]["name"], $acItems[$i]["link"], $i);
                    $accordianAnchorTags .= $anchor;

                }

            }

            $iTag = $this->createITag($index.'-caret', $this->sbITagClasses);
            
            $acButton = $this->createButton("", $this->sbButtonClasses, "", $iTag. "   " .$acName, "accordian('" .$index . "');location.href='".$acLink."'");
            
            $acContainer = $this->createDiv($index, $this->sbAccordianClasses, "", $accordianAnchorTags);
            
        }

        return $acButton . $acContainer;
    }

}

class contentBuilder extends htmlBuilder{

    use colors;
    use contentStyles;

    public $content;
    public $mainContent;

    public function initialize(){
        $mainContent = $this->createDiv("mainContent", $this->mainContentClasses, "", "", "");
        $content = $this->createDiv("", $this->contentContainerClasses, "", $mainContent, "");
        echo $content;
    }


    public function createDivContent($content, $id="", $style="", $tabIndex="") {

        $div = $this->createDiv($id, $this->contentDivClasses, $style, $content, $tabIndex);

        return $div;
    }


    public function createAnchorContent($content, $link, $id="", $style="", $tabIndex="") {

        $anchor = $this->createAnchor($id, $this->contentAnchorClasses, $style, $content, $link, $tabIndex);

        return $anchor;
    }


    public function createButtonContent($content, $onclick="", $id="", $style="", $tabIndex="") {

        $button = $this->createButton($id, $this->contentButtonClasses, $style, $content, $onclick, $tabIndex);
        
        return $button;
    }


    public function createImageCard($source, $caption1="", $caption2="", $caption3="", $alt="Could not find image", $id="", $style="", $width="", $height="", $tabIndex=""){


        $image = $this->createImage($id, $this->contentImageClasses, "", $source, $alt, $width, $height, $tabIndex);

        $caption1 = '<h4><b>'.$caption1.'</b></h4>';
        $caption2 = $this->createPanelContent($caption2);
        $caption3 = $this->createPanelContent($caption3);

        $container = $this->createDiv("", "bioContainer w3-container", "", $caption1.$caption2.$caption3);
    
        $image = $this->createDiv("", "w3-card-4", "width:50%", $image.$container);

        return $image;
    }


    public function createImageContent($source, $alt="Could not find image", $id="", $style="", $width="", $height="", $tabIndex=""){

        $image = $this->createImage($id, $this->contentImageClasses, $style, $source, $alt, $width, $height, $tabIndex);

        $image = $this->createDiv("", "w3-card-4", "width:19%", $image);

        return $image;
    }


    public function createPanelContent($content, $id="", $style="", $tabIndex="") {

        $panel = $this->createPTag($id, $this->contentPTagClasses, $style, $content,  $tabIndex);

        return $panel;
    }
}




