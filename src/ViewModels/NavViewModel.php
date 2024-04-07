<?php

namespace ViewModels;

use ViewModels\Builders\HtmlBuilder;

class NavViewModel extends HtmlBuilder implements ViewModel{

    // use Builders\ClassList;

    public $pageData;

    public function __construct($pageData)
    {
        // TODO: error handle if pageData not array
        $this->pageData = $pageData;
    }

    public function render($classList)
    {

        if (!is_array($this->pageData) || count($this->pageData) == 0)
        {
            return '';
        }


        $logo = $this->buildElement('img')
                    ->classList($classList['logo'])
                    ->src($classList['logoLocation'])
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

        $menu = $menuBuilder->createMenu($this->pageData, $classList);

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


