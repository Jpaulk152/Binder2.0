<?php

namespace Views\Elements;

use Views\View;
use \config;

class Sidebar extends View
{
    public Menu $menu;
    public Element $openButton;

    public function __construct(...$rows)
    {
        $closeButton = new Element('button', 'Close &times;', ['class'=>'closeButton w3-bar-item w3-button w3-medium', 'onclick'=>'closeSideBar(event)']);

        $this->menu = new Menu(Button::class, 'hcPageContent', [], Expander::class,  'hcPageContent', [], 'children', ...$rows);

        $this->menu->addAttributes(['class'=>'menu w3-container w3-bar-block', 'width'=>'350px', 'height'=>'100%']);

        array_unshift($this->menu->elements, $closeButton);

        $this->openButton = new Element('button', '&#9776', ['class'=>'openButton w3-bar-item w3-button w3-large', 'onclick'=>"openSideBar(event)", 'width'=>'54px', 'height'=>'54px', 'style'=>'width:54px;height:54px;']);


        parent::__construct($this->menu, $this->openButton);
        $this->addAttributes(['class'=>'sidebar w3-card-4']);


        $css = '

            .openButton {
                float:left;
                display: block;
                width:54px;
                height:54px;
            }

            .closeButton {
                float:left;
                margin-bottom:10px;
            }

            .sidebar {
                height:54px;
                width:54px;

                position:relative;
                transition: width 500ms, height 500ms;
                border-radius:0 10px 10px 0;
                overflow:hidden;
            }
        
            .sidebar .menu {
                width:350px;
                height:100%;
                font-size:small;
                padding-top:10px;
                padding-bottom:200px;
                overflow:auto;
                float:left;
                display: none;
            }

        ';

        $js = "




            function openSideBar(event) {

                openButton = event.target;
                sidebar = event.target.parentNode;
                menu = sidebar.children[0];

                
                sidebar.style.width = menu.getAttribute('width');
                sidebar.style.height = menu.getAttribute('height');

                openButton.style.display = 'none';
                menu.style.display = 'block';
            };


            
            function closeSideBar(event) {

                menu = event.target.parentNode;
                openButton = menu.nextSibling;
                sidebar = menu.parentNode;
                

                console.log(openButton.getAttribute('width'), openButton.getAttribute('height'))

                sidebar.style.width = openButton.getAttribute('width');
                sidebar.style.height = openButton.getAttribute('height');

                openButton.style.display = 'block'; 
                menu.style.display = 'none';
            };

        ";


        config::includes(['stylesheet'=>$css],['jscripts'=>$js]);
    }
}


// namespace Views\Menus;

// use Views\View;
// use Views\Buttons\Button;
// use Views\Buttons\Expander;
// use Views\Elements\Element;
// use \utilities as u;
// use \config;

// class Sidebar extends View
// {
//     public Menu $menu;
//     public Element $openButton;

//     public function __construct(array ...$rows)
//     {
//         $closeButton = new Element('button', 'Close &times;', ['class'=>'closeButton w3-bar-item w3-button w3-medium', 'onclick'=>'closeSideBar(event)']);

//         $this->menu = new Menu(Button::class, 'hcPageContent', [], Expander::class,  'hcPageContent', [], 'children', ...$rows);

//         $this->menu->addAttributes(['class'=>'menu w3-container w3-bar-block w3-collapse']);

//         array_unshift($this->menu->elements, $closeButton);

//         $this->openButton = new Element('button', '&#9776', ['class'=>'openButton w3-bar-item w3-button w3-large', 'onclick'=>"openSideBar(event)"]);


//         parent::__construct($this->menu, $this->openButton);
//         $this->addAttributes(['class'=>'sidebar primaryBackground w3-card-4', 'style'=>'width:300px;transition: transform 0.5s;']);


//         $css = '

//             .openButton {
//                 display: block;
//                 display:inline-block;
//             }

//             .closeButton {
//                 float:left;
//                 margin-bottom:10px;
//             }

//             .sidebar {
//                 z-index:1;
//                 height:100%;
//                 padding-bottom:200px;
//                 border-radius:0 10px 0 0;
//                 overflow:auto;
    
//                 position:relative;


//                 transition: transform 0.5s;
//             }

//             .sidebar .menu {
    
//                 font-size:small;
//                 padding-top:10px;
//                 display:inline-block;
    
//                 transition: transform 0.5s;
//             }
        

//         ';

//         $js = "



//               function openSideBar(event) {

//             openButton = event.target;
//             openButton.style.display = 'none';

//             sidebar = openButton.nextSibling;
//             sidebar.style.display = 'block';
//             sidebar.style.width = sidebar.originalWidth;

            

//             // console.log('originalWidth:' + sidebar.originalWidth);

//             // sibling = sidebar.nextSibling;

//             // if (sibling)
//             // {
//             //     sibling.style.marginLeft = sidebar.originalWidth;
//             // }
//         };

//         function closeSideBar(event) {

//             sidebar = event.target.parentNode;
//             openButton = sidebar.nextSibling;
        
//             sidebar.originalWidth = sidebar.style.width;

            
//             sidebar.parentNode.style.transform = 'translateX(-250px)';
//             // openButton.style.transform = 'translateX(-'+sidebar.offsetWidth+'px)';
            
//             // openButton.style.display = 'block';


//             setTimeout(function(){

//                 openButton.style.display = 'block';
//                 sidebar.style.display = 'none';
                
//             }, 500)

//         };

//         // function openSideBar(event) {

//         //     col = event.target.parentNode.parentNode;
//         //     row = col.parentNode;

//         //     openButton = event.target;
//         //     openButton.style.display = 'none';
        
//         //     sidebar = event.target.nextSibling;
//         //     sidebar.style.display = 'block';

            

//         //     // console.log(sidebar.originalWidth);

//         //     expandCol(col, row, sidebar.originalWidth);

//         // };


        
//         // function closeSideBar(event) {

//         //     sidebar = event.target.parentElement;
//         //     sidebar.originalWidth = pxToEm(parseInt(window.getComputedStyle(sidebar, null).getPropertyValue('width')));
//         //     sidebar.style.display = 'none';
        
//         //     openButton = sidebar.previousSibling;
//         //     openButton.style.display = 'block'; 

//         //     col = event.target.parentNode.parentNode.parentNode;
//         //     row = col.parentNode;

//         //     collapseCol(col, row);
//         // };
//         ";


//         config::includes(['stylesheet'=>$css],['jscripts'=>$js]);
//     }
// }
























