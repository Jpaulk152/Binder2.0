<?php

namespace Views\ViewModels;

use Views\ViewModels\Builders\HtmlBuilder;

class NavViewModel extends HtmlBuilder implements ViewModel{

    public $pageData;
    public $tabIndex;

    public function __construct($pageData, &$tabIndex=1)
    {
        // TODO: error handle if pageData not array
        $this->pageData = $pageData;
        $this->tabIndex = &$tabIndex;
    }

    public function render($classList)
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


        $logo = $this->buildElement('img')
                    ->classList($classList['logo'])
                    ->src('../resources/logo.png')
                    ->alt('Could not find Image')
                    ->width('70')
                    ->height('70')
                    ->create();

        $homeAnchor = $this->buildElement('a')
                        ->classList($classList['logoContainer'])
                        ->href('../index.php/home')
                        ->content($logo)
                        ->create();


        $menuBuilder = new Builders\MenuBuilder();

        $menu = $menuBuilder->createMenu($this->pageData, $classList, $this->tabIndex);

// die(var_dump($this->classList));

        $navBar = $this->buildElement('div')
                                ->id('navContent')
                                ->classList($classList['menuContainer'])
                                ->content($homeAnchor . $menu)
                                ->create();

        return $navBar;
    }

    public function animateContent(){
        // $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
    }

}


