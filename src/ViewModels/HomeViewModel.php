<?php

namespace ViewModels;

use Models\DB\Select;

class HomeViewModel extends ViewModel{

    public $pageData;
    public $navBar = '';
    public $layout = '';
    public $page = '';

    public function __construct($menu='home')
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
        $mainContentData = $this->pageData['mainContent'];
        $mainContentBuilder = new Builders\MainContentBuilder();
        
        $panelWelcome = $mainContentBuilder->buildElement('div')
                                            ->classList('greeting secondaryBackground w3-panel w3-padding-16')
                                            ->content("<h3>".$mainContentData[0]['welcome']."</h3>")
                                            ->create();

        $imageCard = $mainContentBuilder->createImageCard($mainContentData[1]['imagePath'], $mainContentData[4]['b1'], $mainContentData[5]['b2'], $mainContentData[6]['b3']);

        $panel1 = $mainContentBuilder->createPanelContent($mainContentData[2]['p1']);
        $panel2 = $mainContentBuilder->createPanelContent($mainContentData[3]['p2']);
    
        return $mainContentBuilder->createMainContent($panelWelcome.$imageCard.$panel1.$panel2);
    }

    public function renderSideBar()
    {
        $sideBarBuilder = new Builders\SideBarBuilder();

        return $sideBarBuilder->createSideBar($this->pageData['sideContent']);
    }

    public function renderNavBar()
    {
        $navBarBuilder = new Builders\NavBarBuilder();

        $this->navBar = $navBarBuilder->createNavBar($this->pageData['navContent'], $this->pageData['logoPath']);

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

  


