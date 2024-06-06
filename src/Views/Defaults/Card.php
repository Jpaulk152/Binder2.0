<?php

namespace Views\Defaults;

use Views\View;

use Views\Layout;

class Card extends View
{
    public Layout $layout;

    public function __construct(string $id, string $title, array $views, array $attributes=[], string $onclick='', $buttonClass='')
    {
        $layout = new Layout($id.'-layout', $views, ['style'=>'height: 75%; overflow: auto;']);

        $this->addBundle($layout->bundle);

        $content = $layout->create();

        $content =  $this->build('div')
                        ->attr('class', 'w3-container card-content')
                        ->attr('style', 'width: 100%; height: 85%')
                        ->content('<h2>'.$title.'</h2>'.$content)
                        ->create();

        $div = $this->build('div')
                        ->attr('class', 'w3-container w3-center')
                        ->content('space for button')
                        ->create();


        $card = $this->build('div')
                    ->attr('class', 'w3-card-4 card')
                    ->attr('style', 'width: 100%; height: 100%;')
                    ->content($content.$div)
                    ->create();


        parent::__construct($id, $card, $attributes);

    }
}


