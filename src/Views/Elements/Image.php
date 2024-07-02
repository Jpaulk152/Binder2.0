<?php

namespace Views\Elements;

class Image extends Element
{

    public function __construct(string $path, string $width='100%', string $alt='Could not find image', array $attributes=[])
    {

        parent::__construct('img', '', ['src'=>$path, 'alt'=>$alt, 'width'=>$width, 'style'=>'width:'.$width], $attributes);

    }
}


