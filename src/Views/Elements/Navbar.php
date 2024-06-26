<?php

namespace Views\Elements;

use Views\View;
use Views\Includes\Includes;

use \utilities as u;

class Navbar extends View
{
    public Menu $menu;

    public function __construct(...$rows)
    {
        $function = '';
        $subFunction = '';

        $buttons = [];
        for($i=0;$i<count($rows);$i++)
        {
            if (is_a($rows[$i], Element::class))
            {
                $buttons[$i] = clone $rows[$i];
                $buttons[$i]->addAttributes(['class'=>'w3-bar-item']);
            }
            else if (array_key_exists('children', $rows[$i]))
            {
                $buttons[$i] = new Dropdown(
                    new Button(...$rows[$i]), 
                    new Menu(Button::class, $function, [], Expander::class, $subFunction, [], 'children', ...$rows[$i]['children'])
                );

                $buttons[$i]->elements[0]->setOnclick($subFunction);
                $buttons[$i]->addAttributes([]);
                $buttons[$i]->elements[1]->addAttributes(['style'=>'width:300px;max-height:80vh;overflow:auto;']);
            }
            else
            {
                $buttons[$i] = new Button(...$rows[$i]);
                $buttons[$i]->setOnclick($function);
                $buttons[$i]->addAttributes(['class'=>'w3-bar-item']);
            }
        }


        $logo = new Element('img', '', ['src'=>Includes::path('logo'), 'alt'=>'Could not find Image', 'width'=>'70', 'height'=>'70']);
        $homeButton = new Element('a', $logo->create(), ['class'=>'w3-bar-item w3-button w3-large', 'href'=>'../index.php/home']);

        parent::__construct($homeButton, ...$buttons);
        $this->setTagName('nav');
        $this->addAttributes(['style'=>'position:fixed; z-index:2; top:0; overflow:unset;', 'class'=>'w3-card-4 w3-bar w3-white']);
    }
}


// class Navbar extends Menu
// {
//     public function __construct(array ...$rows)
//     {
//         // $tabIndex = $GLOBALS['tabIndex'];

//         $logo = new Element('img', '', ['src'=>Includes::path('logo'), 'alt'=>'Could not find Image', 'width'=>'70', 'height'=>'70']);
//         $homeButton = new Element('a', $logo->create(), ['class'=>'w3-bar-item w3-button w3-large', 'href'=>'../index.php/home']);

//         parent::__construct(Button::class, 'hcMenu', ['class'=>'w3-bar-item'], Dropdown::class, 'hcMenu', [], 'children', ...$rows);
//         array_unshift($this->elements, $homeButton);
//         $this->addAttributes(['style'=>'position:fixed; z-index:2; top:0; overflow:unset;', 'class'=>'w3-card-4 w3-bar w3-white']);
//     }

// }

