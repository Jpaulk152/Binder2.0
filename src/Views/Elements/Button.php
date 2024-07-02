<?php

namespace Views\Elements;

use \utilities as u;

class Button extends Element
{
    public string $name;

    public function __construct(string $name, string ...$functions)
    {
        $this->name = $name;

        parent::__construct('button', $this->name);

        $this->addAttributes(
            [
                'class'=>'w3-button',
                'onclick'=>implode('; ', $functions)
            ]
        );
    }
}