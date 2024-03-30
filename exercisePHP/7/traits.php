<?php


trait absPath{
    public $absolutePath = "/exercisePHP/7";
}

trait colors {

    public $primaryColor = "#3A6FA0";
    public $secondaryColor = "#FFFFFF";
    public $tertiaryColor = "#35424E";
    public $quaternary = "#7E90A1";

}

trait navStyles {

    public $navContainerClasses = "navBar secondaryBackground w3-bar w3-card-4";
    public $navLogoClasses = "";
    public $navLogoAnchorClasses = "w3-bar-item w3-button w3-large";
    public $navAnchorClasses = "navButton w3-bar-item w3-button w3-large";

    public $ddContainerClasses = "navButton w3-dropdown-hover w3-large";
    public $ddITagClasses = "fa fa-caret-down";
    public $ddButtonClasses = "w3-button";
    public $ddContentClasses = "dropdownContent w3-dropdown-content w3-bar-block w3-card-4";
    public $ddAnchorClasses = "w3-bar-item w3-button";

}

trait sbStyles {

    public $sbContainerClasses = "sideContent primaryBackground w3-container w3-sidebar w3-border w3-bar-block w3-collapse w3-animate-left w3-card";
    public $sbButtonClasses = "sideButton secondaryBackground w3-button w3-block w3-border w3-card-4";
    public $sbAnchorClasses = "w3-bar-item";

    public $sbAnchorContainerClasses = "w3-hide w3-animate-zoom w3-animate-top";
    public $sbAccordianClasses = "primaryBackground w3-hide w3-animate-zoom accordian";
    public $sbITagClasses = "fa fa-caret-right caret";
    public $sbCloseBtnClasses = "w3-bar-item w3-button w3-hide-large";
    public $sbOpenBtnClasses = "w3-button w3-xlarge w3-hide-large";

}

trait contentStyles {
    public $contentContainerClasses = "content secondaryBackground";
    public $mainContentClasses = "mainContent secondaryBackground w3-container";

    public $contentDivClasses = "";

    public $contentButtonClasses = "w3-button";
    public $contentAnchorClasses = "";

    public $contentImageClasses = "w3-round";
    public $contentPTagClasses = "primaryBackground w3-panel w3-card-4 w3-padding-16 w3-round-large";
}

