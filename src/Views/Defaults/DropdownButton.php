<?php

namespace Views\Defaults;

use Views\View;

class DropdownButton extends View
{
    public function __construct(string $content, string $children, string $onclick='')
    {
        $caret = '';
        $subMenu = '';
        $onclick = $onclick.';';
        if(!empty($children))
        {
            $caret = $this->build('i')
                            ->attr('class', 'fa fa-caret-down')
                            ->create();

            $subMenu = $this->build('div')
                            ->attr('class', 'w3-dropdown-content w3-bar-block w3-card-4')
                            ->content($children)
                            ->create();
        }
        
        $subMenuButton = $this->build('button')
                                ->attr('class', 'w3-button')
                                ->attr('onclick', $onclick)
                                ->content($caret . ' ' . $content)
                                ->create();

        $this->element = $this->build('div')
                                ->attr('class', 'w3-dropdown-hover')
                                ->content($subMenuButton . $subMenu);
    }

}