<?php

namespace Views\Defaults;

use Views\View;
use Views\Defaults\Cell;

class Row extends View
{
    public function __construct($cells, string $classes='')
    {
        // // if (is_a($cells, 'Views\Defaults\Cell'))
        // // {
        // //     $this->element = $this->build('div')->attr('class', 'w3-container w3-cell-row ' . $classes)->content($cells->create());
        // // }

        // // else if (is_array($cells))
        // // {
        // //     foreach($cells as $cell)
        // //     {
        // //         $content = '';
        // //         if (is_a($cells, 'Views\Defaults\Cell'))
        // //         {
        // //             $content .= $cell->create();
        // //         }
        // //     }
        // //     $this->element = $this->build('div')->attr('class', 'w3-container w3-cell-row ' . $classes)->content($content);
        // // }

        // // else
        // // {
        // //     $this->element = $this->build('div');
        // // }

        // $cells = [new Cell('cell1'), new Cell('cell2'), new Cell('cell3')];

        $content = '';
        foreach($cells as $cell)
        {
            $content .= $cell->create();
        }
        $this->element = $this->build('div')->attr('class', 'w3-cell-row ' . $classes)->content($content);

    }
}