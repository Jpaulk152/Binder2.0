<?php

namespace Views\Layouts;

use Views\ViewError;
use \utilities as u;

class DefaultLayout extends Layout
{   
    public $nav;
    public $side;
    public $main;

    public function __construct($nav=null, $side=null, $main=null)
    {
        $this->nav = $nav;
        $this->side = $side;
        $this->main = $main;

        $this->setView('nav', $this->nav)
                        ->attr('class', 'navMenuContainer secondaryBackground w3-bar w3-card-4')
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

        $this->layoutClass = 'homeLayout';

        return $this;
    }
}