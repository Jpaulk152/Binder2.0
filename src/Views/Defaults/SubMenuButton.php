<?php

namespace Views\Defaults;

use Views\View;

use Views\Defaults\ProgressCircle;

class SubMenuButton extends View
{
    public string $name;

    public array $classLists = 
    [
        'Default' =>
        [
            'caret' => 'sideCaret fa fa-caret-right caret',
            'subMenuButton' => 'sideSubMenuButton sideMenuButton secondaryBackground w3-button w3-block w3-border w3-card-4',
            'subMenu' => 'sideSubMenu primaryBackground w3-hide w3-animate-zoom accordian',
            'subMenuContainer' => 'sideSubMenuContainer',
            'menuButton' => 'sideMenuButton w3-bar-item w3-button',
        ],

        'Other' =>
        [
            'caret' => 'sideCaret fa fa-caret-right caret',
            'subMenuButton' => 'sideSubMenuButton sideMenuButton w3-dark-grey w3-button w3-block w3-card-4',
            'subMenu' => 'sideSubMenu w3-hide w3-animate-zoom accordian',
            'subMenuContainer' => 'sideSubMenuContainer',
            'menuButton' => 'sideMenuButton w3-bar-item w3-button w3-hover-grey',
        ]
    ];

    public function __construct(string $content, string $children, string $onclick='', array $classList=[])
    {
        if (empty($classList))
        {
            $classList = $this->classLists['Other'];
        }

        $caret = '';
        $subMenu = '';
        $onclick = $onclick.';';
        if(!empty($children))
        {
            $caret = $this->build('i')
                            ->attr('class', $classList['caret'])
                            ->create();

            $subMenu = $this->build('div')
                            ->attr('class', $classList['subMenu'])
                            // ->attr('style', 'width: 200px')
                            ->content($children)
                            ->create();

            $onclick='expand(this);'.$onclick;
        }
        
        $subMenuButton = $this->build('button')
                                ->attr('class', $classList['subMenuButton'])
                                ->attr('onclick', $onclick)
                                ->content($caret . ' ' . $content)
                                ->create();


        

        $this->element = $this->build('div')
                                ->attr('class', $classList['subMenuContainer'])
                                ->content($subMenuButton . $subMenu);
    }

}