<?php

namespace Views\Layouts;

use Views\View;

class TestLayout extends Layout
{
    public View $nav;
    public View $side;
    public View $main;

    public function __construct($nav=null, $side=null, $main=null)
    {     
        $this->nav = new View('Navbars/default.php', $nav);
        $this->side = new View('Sidebars/default.php', $side);
        $this->main = new View('Forms/default.php', $main);

        $this->setView('nav', $this->nav)
                        ->attr('class', 'navMenuContainer tertiaryBackground w3-bar w3-card-4')
                        ->attr('id', 'navContent');

        $this->setView('side', $this->side)
                     ->attr('id', 'sideContent');

        $classes = 'w3-container mainContent';
        if ($this->side != null)
        {
            $classes .= ' mainContentToRight';
        }
        $this->setView('main', $this->main)
                    ->attr('class', $classes)
                    ->attr('id', 'mainContent');

        $this->layoutClass = 'testLayout';

        return $this;
    }
}