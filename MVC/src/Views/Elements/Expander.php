<?php

namespace Views\Elements;

use Views\View;
use \config;

class Expander extends View
{
    public function __construct(Element $button, Menu $menu)
    {
        $caret = new Element('i', '   ', ['class'=>'fa fa-caret-right caret']);
        $button->before($caret->create());
        $button->addAttributes(['class'=>'button w3-block w3-border w3-round-large w3-card-4', 'onclick'=>'expand(event);']);
        
        $menu->addAttributes(['class'=>'w3-hide w3-animate-zoom', 'style'=>'margin-left: 30px;']);
        foreach($menu->elements as $element)
        {
            $element->addAttributes(['style'=>'float:none; text-align:left; width:100%; white-space:wrap;']);
        }

        parent::__construct($button, $menu);

        $this->addAttributes(['class'=>'expander']);


        $css = '
        
        ';

        $js = "

        ";

        config::includes(['stylesheet'=>$css],['jscripts'=>$js]);
     }
}