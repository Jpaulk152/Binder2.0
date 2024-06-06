<?php

namespace Views\Defaults;

use Views\View;

class Image extends View
{

    public function __construct(string $id, string $path, string $alt='Could not find image', array $attributes=[], string $onclick='', $buttonClass='')
    {

        $image = $this->build('img')
                        ->attr('src', $path)
                        ->attr('alt', $alt)
                        ->create();

        parent::__construct($id, $image, $attributes);

    }
}


