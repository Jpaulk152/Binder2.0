<?php

namespace Views\ViewModels;

use Views\ViewModels\Builders\HtmlBuilder;

class SideViewModel extends HtmlBuilder{

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


        $menuBuilder = new Builders\MenuBuilder();
        $menu = $menuBuilder->createMenu($this->pageData, $classList, $this->tabIndex, $itemTitle, $itemLink);

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


