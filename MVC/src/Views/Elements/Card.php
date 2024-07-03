<?php

namespace Views\Elements;

use Views\View;

class Card extends View
{
    public function __construct(string $name, ...$elements)
    {
        $header = new Element('h2', $name);
        $view = new View(...$elements);
        $view->addAttributes(['style'=>'height: 75%; overflow: auto;']);

        $div = new Element('div', 'space for button', ['class'=>'w3-container w3-center w3-margin']);

        parent::__construct($header, $view, $div);
        $this->addAttributes(['class'=>'w3-card-4 card', 'style'=>'padding:0.01em 16px;']);
    }
}



// .card .card-content {
//     /* background-color: #99B4BF; */
//     background-color: #A7E0FC;
// }

// .card .circular-progress circle.fg {
//     /* stroke: #56BCFF; */
//     /* stroke: #7BF558; */
//     /* stroke: #57C4E8; */
//     stroke: #00E278;
// }

// .card .circular-progress circle.bg {
//     /* stroke: #56BCFF; */
//     /* stroke: #7BF558; */
//     /* stroke: #57C4E8; */
//     stroke: rgba(252, 249, 249, 0.808);
// }

// .card svg text {
//     fill: black;
// }


