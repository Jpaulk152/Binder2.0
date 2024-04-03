<?php

namespace ViewModels;

use Models\DB\Select;

class CurriculumViewModel extends ViewModel{

    public $pageData;
    public $navBar = '';
    public $layout = '';
    public $page = '';

    public function __construct($menu)
    {
        $this->pageData = $this->getData($menu);
    }

    public function getData($table){

        // Error handle the db connection
        $select = new Select();

        // Sanitize and Validate Data
        return $select->from($table);
    }

    public function renderMainContent()
    {
        $mainContentBuilder = new Builders\MainContentBuilder();

        $mainContent = $mainContentBuilder->createMainContent();

        return $mainContent;
    }

    public function renderSideBar()
    {
        $sideBarBuilder = new Builders\SideBarBuilder();

        return $sideBarBuilder->createSideBar($this->pageData['sideContent']);
    }

    public function renderNavBar()
    {
        $navBarBuilder = new Builders\NavBarBuilder();

        $this->navBar = $navBarBuilder->createNavBar($this->pageData['navContent']);

        return $this->navBar;
    }

    public function renderLayout()
    {
        $layoutBuilder = new Builders\LayoutBuilder();
        $this->layout = $layoutBuilder->createHomeLayout($this->renderNavBar() . $this->renderSideBar() . $this->renderMainContent());

        return $this->layout;
    }


    public function animateContent(){
        $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
    }

}


