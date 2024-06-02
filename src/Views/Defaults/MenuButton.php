<?php

namespace Views\Defaults;

use Views\View;

class MenuButton extends View
{
    public function __construct(string $content, string $onclick='')
    {
        $menuButton = $this->build('button')
                            ->attr('class', 'w3-bar-item w3-button');

        if (!empty($onclick))
        {
            $menuButton->attr('onclick', $onclick);
        }
        $menuButton->content($content);

        $this->element = $menuButton;
    }
}