<?php

namespace Views\Defaults;

use Views\View;

class ExpandButton extends View
{
    public function __construct(string $content, string $children, string $onclick='')
    {
        $caret = '';
        $subMenu = '';
        $onclick = $onclick.';';
        if(!empty($children))
        {
            $caret = $this->build('i')
                            ->attr('class', 'fa fa-caret-right caret')
                            ->create();

            $subMenu = $this->build('div')
                            ->attr('class', 'w3-hide accordian w3-animate-zoom')
                            ->content($children)
                            ->create();

            $onclick='expand(this);'.$onclick;
        }
        
        $subMenuButton = $this->build('button')
                                ->attr('class', 'sideSubMenuButton secondaryBackground w3-button w3-block w3-border w3-card-4')
                                ->attr('onclick', $onclick)
                                ->content($caret . ' ' . $content)
                                ->create();

        $this->element = $this->build('div')
                                ->content($subMenuButton . $subMenu);
    }

}