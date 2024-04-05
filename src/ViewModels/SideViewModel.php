<?php

namespace ViewModels;

use ViewModels\Builders\HtmlBuilder;

class SideViewModel extends HtmlBuilder implements ViewModel{

    use Builders\ClassList;

    public $pageData;

    public function __construct($pageData)
    {
        // TODO: error handle if pageData not array
        $this->pageData = $pageData;
    }

    public function render($classList)
    {
        $menuBuilder = new Builders\MenuBuilder();
        $menu = $menuBuilder->createMenu($this->pageData, $classList);

        // button to open menu on small screen formats
        $openButton = $this->buildElement('button')
                            ->id('sideContentButton')
                            ->classList($classList['openButton'])
                            ->style('float:left')
                            ->onclick('openSideBar()')
                            ->content('&#9776')
                            ->create();

        // button to close menu on small screen formats
        $closeButton = $this->buildElement('button')
                            ->classList($classList['closeButton'])
                            ->onclick('closeSideBar()')
                            ->content('Close &times;')
                            ->create();

        // contains the menu just builter, closeButton goes in adjacent to it
        $sideBar = $this->buildElement('div')
                                ->id('sideContent')
                                ->classList($classList['menuContainer'])
                                ->content($closeButton . $menu)
                                ->create();

        return $openButton . $sideBar;
    }

    public function animateContent(){
        // $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
    }

}


