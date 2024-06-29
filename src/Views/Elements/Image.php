<?php

namespace Views\Elements;

class Image extends Element
{

    public function __construct(string $path, string $alt='Could not find image', array $attributes=[])
    {

        parent::__construct('img', '', ['src'=>$path, 'alt'=>$alt], $attributes);

    }
}


