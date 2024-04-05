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
        $classList = array(
            'menuContainer' => 'sideContent primaryBackground w3-container w3-sidebar w3-border w3-bar-block w3-collapse w3-animate-left w3-card',
            'menuButton' => 'w3-bar-item',
    
            'subMenu' => 'primaryBackground w3-hide w3-animate-zoom accordian',
            'subMenuContainer' => '',
            'subMenuButton' => 'sideButton secondaryBackground w3-button w3-block w3-border w3-card-4',
        
            'caret' => 'fa fa-caret-right caret',
            'openButton' => 'w3-button w3-xlarge w3-hide-large',
            'closeButton' => 'w3-bar-item w3-button w3-hide-large',
            
            'logo' => '',
            'logoContainer' => '',
            'logoLocation' => ''
        );

        return $classList;
    }

    public function navClasses()
    {

        $classList = array(
            'menuContainer' => 'navBar secondaryBackground w3-bar w3-card-4',
            'menuButton' => 'navButton w3-bar-item w3-button w3-large',
        
            'subMenu' => 'dropdownContent w3-dropdown-content w3-bar-block w3-card-4',
            'subMenuContainer' => 'navButton w3-dropdown-hover w3-large',
            'subMenuButton' => 'w3-button',
        
            'caret' => 'fa fa-caret-down',
            'openButton' => '',
            'closeButton' => '',
            
            'logo' => '',
            'logoContainer' => 'w3-bar-item w3-button w3-large',
            'logoLocation' => '../src/resources/logo.png'
        );

        return $classList;
    }

    public function layoutClasses()
    {
        $classList = array(
            'homeLayout' => 'homeLayout secondaryBackground',
            'lessonLayout' => 'lessonLayout secondaryBackground',
            'curriculumLayout' => ''
        );

        return $classList;
    }


    public function mainClasses()
    {
        
    }

}
