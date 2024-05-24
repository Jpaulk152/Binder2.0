<?php

namespace Views\ViewModels;

use Views\HtmlBuilder;
use Views\MenuBuilder;

class NavViewModel extends HtmlBuilder{

    public $pageData;
    public $tabIndex;

    public function __construct($pageData, &$tabIndex=1)
    {
        // TODO: error handle if pageData not array
        $this->pageData = $pageData;
        $this->tabIndex = &$tabIndex;
    }

    public function render($classList, $itemTitle='name', $itemLink='link')
    {

        
        $list = array();

        foreach($classList as $item)
        {
            $list[$item['title']] = $item['list'];
        }

        $classList = $list;


        if (!is_array($this->pageData) || count($this->pageData) == 0)
        {
            return '';
        }


        $logo = $this->build('img')
                    ->attr('class', $classList['logo'])
                    ->attr('src', '../resources/logo.png')
                    ->attr('alt', 'Could not find Image')
                    ->attr('width', '70')
                    ->attr('height', '70')
                    ->create();

        $homeAnchor = $this->build('a')
                        ->attr('class', $classList['logoContainer'])
                        ->attr('href', '../index.php/home')
                        ->content($logo)
                        ->create();


        $menuBuilder = new MenuBuilder();

        $menu = $menuBuilder->createMenu($this->pageData, $classList, $this->tabIndex, $itemTitle, $itemLink);

        // die(var_dump($this->classList));

        // $menu = '';

        $navBar = $this->build('div')
                        ->attr('id', 'navContent')
                        ->attr('class', $classList['menuContainer'])
                        ->content($homeAnchor . $menu)
                        ->create();

        return $navBar;
    }

    public function animateContent(){
        // $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
    }

}


