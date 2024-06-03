<?php

namespace Views\Buttons;

use Views\View;

class Expander extends View
{
    public function __construct(string $content, string $children, string $onclick='')
    {
        if(!empty($children))
        {
            $caret = $this->build('i')
                            ->attr('class', 'fa fa-caret-right caret')
                            ->create();

            $subMenu = $this->build('div')
                            ->attr('class', 'submenu w3-hide w3-animate-zoom')
                            ->content($children)
                            ->create();

            $onclick='expand(this);'.$onclick.';';
        }
        
        $button = $this->build('button')
                                ->attr('class', 'button w3-button w3-block w3-border w3-card-4')
                                ->attr('onclick', $onclick)
                                ->content($caret . ' ' . $content)
                                ->create();

        $this->element = $this->build('div')
                                ->attr('class', 'expander')
                                ->content($button . $subMenu);
    }

}