<?php

namespace Views;

$htmlBuilder = new HTMLBuilder();

$logo =         $htmlBuilder->build('img')
                            ->attr('class', 'navLogo')
                            ->attr('src', '../resources/logo.png')
                            ->attr('alt', 'Could not find Image')
                            ->attr('width', '70')
                            ->attr('height', '70')
                            ->create();

$homeAnchor =   $htmlBuilder->build('a')
                            ->attr('class', 'navLogoContainer w3-bar-item w3-button w3-large')
                            ->attr('href', '../index.php/home')
                            ->content($logo)
                            ->create();

$classList = [
    'caret' => 'navCaret fa fa-caret-down',
    'subMenuButton' => 'navSubMenuButton w3-button',
    'subMenu' => 'navSubMenu w3-dropdown-content w3-bar-block w3-card-4',
    'subMenuContainer' => 'navSubMenuContainer w3-dropdown-hover w3-large',
    'menuButton' => 'navMenuButton w3-bar-item w3-button w3-large'
];

$menu = $htmlBuilder->createMenu($entity, $classList, $tabIndex);

echo $homeAnchor . $menu;