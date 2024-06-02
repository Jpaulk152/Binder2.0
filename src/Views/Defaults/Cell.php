<?php

namespace Views\Defaults;

use Views\View;

class Cell extends View
{
    public function __construct(string $content, string $classes='', $css='', $js='')
    {
        $this->element = $this->build('div')->attr('class', 'w3-container w3-cell ' . $classes)->content($content);
    }
}