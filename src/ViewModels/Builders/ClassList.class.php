<?php

namespace ViewModels\Builders;

trait ClassList
{
    public $menuContainer;
    public $menuButton;

    public $subMenu;
    public $subMenuContainer;
    public $subMenuButton;

    public $caret;
    public $openButton;
    public $closeButton;
    
    public $logo;
    public $logoContainer;
    public $logoLocation;

    public function sideClasses()
    {
        $this->menuContainer = 'sideContent primaryBackground w3-container w3-sidebar w3-border w3-bar-block w3-collapse w3-animate-left w3-card';
        $this->menuButton = 'w3-bar-item';
    
        $this->subMenu = 'primaryBackground w3-hide w3-animate-zoom accordian';
        $this->subMenuContainer = '';
        $this->subMenuButton = 'sideButton secondaryBackground w3-button w3-block w3-border w3-card-4';
    
        $this->caret = 'fa fa-caret-right caret';
        $this->openButton = 'w3-button w3-xlarge w3-hide-large';
        $this->closeButton = 'w3-bar-item w3-button w3-hide-large';
        
        $this->logo = '';
        $this->logoContainer = '';
        $this->logoLocation = '';
    }

    public function navClasses()
    {
        $this->menuContainer = 'navBar secondaryBackground w3-bar w3-card-4';
        $this->menuButton = 'navButton w3-bar-item w3-button w3-large';
    
        $this->subMenu = 'dropdownContent w3-dropdown-content w3-bar-block w3-card-4';
        $this->subMenuContainer = 'navButton w3-dropdown-hover w3-large';
        $this->subMenuButton = 'w3-button';
    
        $this->caret = 'fa fa-caret-down';
        $this->openButton = '';
        $this->closeButton = '';
        
        $this->logo = '';
        $this->logoContainer = 'w3-bar-item w3-button w3-large';
        $this->logoLocation = '../src/resources/logo.png';
    }

}
