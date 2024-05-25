<?php

namespace Views;

$htmlBuilder = new HTMLBuilder();

$classList = [
    'caret' => 'sideCaret fa fa-caret-right caret',
    'subMenuButton' => 'sideSubMenuButton sideMenuButton secondaryBackground w3-button w3-block w3-border w3-card-4',
    'subMenu' => 'sideSubMenu primaryBackground w3-hide w3-animate-zoom accordian',
    'subMenuContainer' => 'sideSubMenuContainer',
    'menuButton' => 'sideMenuButton w3-bar-item'
];

if (empty($entity))
{
    $menu = $htmlBuilder->createMenu([], $classList, $tabIndex);
}
else
{
    $menu = $htmlBuilder->createMenu($entity, $classList, $tabIndex);
}

        // button to open menu on small screen formats
        $openButton = $htmlBuilder->build('button')
                            ->attr('id', 'sideContentButton')
                            ->attr('class', 'sideOpenButton w3-button w3-xlarge w3-hide-large')
                            ->attr('style', 'float:left')
                            ->attr('onclick', 'openSideBar()')
                            ->content('&#9776')
                            ->create();

        // button to close menu on small screen formats
        $closeButton = $htmlBuilder->build('button')
                            ->attr('class','sideCloseButton w3-bar-item w3-button w3-hide-large')
                            ->attr('onclick', 'closeSideBar()')
                            ->content('Close &times;')
                            ->create();

        // contains the menu just builter, closeButton goes in adjacent to it
        $sideBar = $htmlBuilder->build('div')
                                ->attr('id', 'sideContent')
                                ->attr('class', 'sideMenuContainer tertiaryBackground w3-container w3-sidebar w3-border w3-bar-block w3-collapse w3-animate-left w3-card')
                                ->content($closeButton . $menu)
                                ->create();

echo $openButton . $sideBar;