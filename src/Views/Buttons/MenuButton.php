<?php

namespace Views\Buttons;

use Views\View;

class MenuButton extends View
{
    public function __construct(string $content, string $onclick='')
    {
        $button = $this->build('button')
                            ->attr('class', 'menubutton w3-bar-item w3-button');

        if (!empty($onclick))
        {
            $button->attr('onclick', $onclick);
        }
        $button->content($content);

        $this->element = $button;
    }
}