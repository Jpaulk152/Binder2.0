<?php

namespace Views\Elements;

use Views\View;
use Views\Layout;

use \config;

class Panel extends View
{
    public Layout $layout;

    public function __construct(string $name, array ...$rows)
    {
        $header = new Element('h2', $name);
        $this->layout = new Layout(...$rows);
        $this->layout->addAttributes(['style'=>'overflow: auto;']);
      
        parent::__construct($header, $this->layout);

        $this->addAttributes(['class'=>'panel w3-container w3-card-4', 'style'=>'overflow:hidden;']);

        $css = '
    
            .panel {
                max-width: 98%;
                padding: 0 20px;
                margin: 1em auto 5em;
                background: #fff;
                color: #333;
                /* font: 1.156em / 1.3 My Gill Sans, Lato, sans-serif; */
                font-size-adjust: 0.45;
                position: relative;
                box-shadow: 0 .3em 1em #000;

                border-radius: 10px;

            }

            .panel .layout .w3-row > .w3-col, .panel .layout .w3-row > .w3-rest {
                padding: 16px !important;
            }

        ';

        config::includes(['stylesheet'=>$css]);

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


