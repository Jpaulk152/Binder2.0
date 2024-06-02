<?php

namespace Views\Containers;

use Views\View;

class Resizer extends View
{
    public array $classLists = 
    [
        'HCDefault' =>
        [
            'caret' => 'navCaret fa fa-caret-down',
            'subMenuButton' => 'navSubMenuButton w3-button',
            'subMenu' => 'navSubMenu w3-dropdown-content w3-bar-block w3-card-4',
            'subMenuContainer' => 'navSubMenuContainer w3-dropdown-hover w3-large',
            'menuButton' => 'navMenuButton w3-bar-item w3-button w3-large',
            'logo' => 'navLogo',
            'homeButton' => 'navLogoContainer w3-bar-item w3-button w3-large',
            'navContainer' => 'navMenuContainer secondaryBackground w3-bar w3-card-4'
            
        ],

        'Default' =>
        [
            'caret' => 'navCaret fa fa-caret-down',
            'subMenuButton' => 'navSubMenuButton w3-button',
            'subMenu' => 'navSubMenu w3-grey w3-dropdown-content w3-bar-block w3-card-4',
            'subMenuContainer' => 'navSubMenuContainer w3-dropdown-hover w3-large',
            'menuButton' => 'navMenuButton w3-bar-item w3-button w3-large',
            'logo' => 'navLogo',
            'homeButton' => 'navLogoContainer w3-bar-item w3-button w3-large',
            'navContainer' => 'navMenuContainer w3-black w3-bar w3-card-4'
        ]
    ];

    public function __construct(string $words='')
    {

        $this->cssBundle = '
            <style>
                body {
                    position: relative;
                    height: auto;
                    min-height: 100vh;
                    display: flex;
                    -webkit-box-orient: vertical;
                    -webkit-box-direction: normal;
                    overflow: hidden;
                    margin: 0;
                }
                
                #wrapper {
                    -webkit-box-orient: vertical;
                    -webkit-box-direction: normal;
                    flex-direction: column;
                    overflow: hidden;
                    position: absolute;
                    height: 100%;
                    width: 100%;
                    display: flex;
                    margin: 0;
                    padding: 0;
                }
                
                #container {
                    width: 100%;
                    height: 100%;
                    flex-shrink: 0;
                    position: relative;
                    display: flex;
                    overflow: hidden;
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                #sidebar {
                    height: 100%;
                    position: relative;
                    margin 0;
                    padding: 0;
                    box-sizing: border-box;
                    background: lightgray;
                    border: 2px solid darkgray;
                
                    min-width: 0;
                }
                
                #resizer {
                    flex-basis: 18px;
                    
                    position: relative;
                    z-index: 2;
                    cursor: col-resize;
                    border-left: 1px solid rgba(255, 255, 255, 0.05);
                    border-right: 1px solid rgba(0, 0, 0, 0.4);
                    background: #333642;
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                

            </style>
        ';

        $this->jsBundle = "
            <script>
                const resizer = document.querySelector('#resizer');
                const sidebar = document.querySelector('#sidebar');

                resizer.addEventListener('mousedown', (event) => 
                {
                    document.addEventListener('mousemove', resize, false);
                    document.addEventListener
                    (
                        'mouseup', 
                        () => 
                        {
                            document.removeEventListener('mousemove', resize, false);
                        },
                        false
                    );
                });

                function resize(e)
                {
                    console.log(e);
                    const size = e.clientX + 'px';
                    sidebar.style.flexBasis = size;
                }

                /** 
                 * Helpers 
                 */

                sidebar.style.flexBasis = '325px';
                
            </script>
        ";


        $sidebar = $this->build('div')
                        ->attr('id', 'sidebar')
                        ->content('<p>'.$words.'</p>')
                        ->create();
        $resizer = $this->build('div')
                        ->attr('id', 'resizer')
                        ->create();

        $container = $this->build('div')
                        ->attr('id', 'container')
                        ->content($sidebar.$resizer)
                        ->create();
        $wrapper = $this->build('div')
                        ->attr('id', 'wrapper')
                        ->content($container);

        $this->element = $wrapper;
    }
 
}

