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
        
            .expander > button:first-child {
                display: flex;
                justify-content: left;
                align-items: center;
                margin: 10px auto;
            
                text-align: left;
                white-space: normal;
                min-height: 75px;
            
                background-color: #FFFFFF;
                color: black;
            }
        
        ';

        $js = "
            function expand(event){

                var expander = event.target.parentElement;
                var caret = expander.children[0].children[0];
                var menu = expander.children[1];

                if(menu.className.indexOf('w3-show') == -1) {

                    caret.className = caret.className.replace('fa-caret-right', 'fa-caret-down');
                    menu.className = menu.className.replace('w3-hide', 'w3-show');

                }
                else {

                    recursiveClose(expander);
                    caret.className = caret.className.replace('fa-caret-down', 'fa-caret-right');
                    menu.className = menu.className.replace('w3-show', 'w3-hide');
                    
                }
            }

            function recursiveClose(node) {

                for (var i=0; i<node.childNodes.length; i++){
                    var child = node.childNodes[i];

                    recursiveClose(child);

                    // console.log(child + '   ' + child.classList);
                    if (typeof(child.classList) != 'undefined'){
                        if (child.classList.contains('expander'))
                        {
                            var expander = child;
                            var caret = expander.children[0].children[0];
                            var menu = expander.children[1];

                            caret.className = caret.className.replace('fa-caret-down', 'fa-caret-right');
                            menu.className = menu.className.replace('w3-show', 'w3-hide');
                        }
                    }
                }
            }
        ";

        config::includes(['stylesheet'=>$css],['jscripts'=>$js]);
     }
}