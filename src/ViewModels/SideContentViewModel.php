<?php

namespace ViewModels;

class SideContentViewModel extends ViewModel{

    public $pageData;
    public $navBar = '';
    public $layout = '';
    public $page = '';

    public function __construct($pageData)
    {
        // TODO: error handle if pageData not array

        $this->pageData = $pageData;
    }

    public function getData($table)
    {

    }


    public function renderMainContent()
    {

    }

    public function renderSideBar()
    {
        $menuBuilder = new Builders\MenuBuilder();

        // $sideBarBuilder = new Builders\SideBarBuilder();

        return $menuBuilder->createMenu($this->pageData['sideContent']);
    }

    public function renderNavBar()
    {

    }

    public function renderLayout()
    {
        
    }


    public function animateContent(){
        $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
    }

}


