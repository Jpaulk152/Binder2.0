<?php

namespace ViewModels\Builders;

trait ClassList
{
    public function navClasses()
    {

        $classList = array(

            'menuButton' => 'navMenuButton w3-bar-item w3-button w3-large',
            'menuContainer' => 'navMenuContainer secondaryBackground w3-bar w3-card-4',
          
            'subMenuButton' => 'navSubMenuButton w3-button',
            'subMenuContainer' => 'navSubMenuContainer w3-dropdown-hover w3-large',
            'subMenu' => 'navSubMenu w3-dropdown-content w3-bar-block w3-card-4',
           
            'caret' => 'navCaret fa fa-caret-down',
            'openButton' => '',
            'closeButton' => '',
            
            'logo' => 'navLogo',
            'logoContainer' => 'navLogoContainer w3-bar-item w3-button w3-large',
            'logoLocation' => '../resources/logo.png'
            
        );

        return $classList;
    }

    public function sideClasses()
    {
        $classList = array(

            'menuButton' => 'sideMenuButton w3-bar-item',
            'menuContainer' => 'sideMenuContainer primaryBackground w3-container w3-sidebar w3-border w3-bar-block w3-collapse w3-animate-left w3-card',
    
            'subMenuButton' => 'sideMenuButton sideSubMenuButton secondaryBackground w3-button w3-block w3-border w3-card-4',
            'subMenuContainer' => 'sideSubMenuContainer',
            'subMenu' => 'sideSubMenu primaryBackground w3-hide w3-animate-zoom accordian',

            'caret' => 'sideCaret fa fa-caret-right caret',
            'openButton' => 'sideOpenButton w3-button w3-xlarge w3-hide-large',
            'closeButton' => 'sideCloseButton w3-bar-item w3-button w3-hide-large',
            
            'logo' => 'sideLogo',
            'logoContainer' => 'sideLogoContainer',
            'logoLocation' => ''

        );

        return $classList;
    }

    public function layoutClasses()
    {
        $classList = array(
            'homeLayout' => 'homeLayout secondaryBackground',
            'lessonLayout' => 'lessonLayout secondaryBackground',
            'curriculumLayout' => 'curriculumLayout secondaryBackground'
        );

        return $classList;
    }


    public function mainClasses()
    {
        
    }

}
