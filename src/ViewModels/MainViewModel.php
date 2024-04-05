<?php

namespace ViewModels;

use ViewModels\Builders\HtmlBuilder;

class MainViewModel extends HtmlBuilder implements ViewModel{

    use Builders\ClassList;

    public $pageData;

    public function __construct($pageData)
    {
        // TODO: error handle if pageData not array
        $this->pageData = $pageData;
    }

    public function render($classList)
    {
        

        // $menuBuilder = new Builders\MenuBuilder2();

        // $sideBar = $menuBuilder->getMenu($this->pageData, $this->classList);

        // $sideBarBuilder = new Builders\SideBarBuilder();

        // return $sideBar;

        return $this->renderMainContent();
    }

    public function renderMainContent()
    {

        if (!is_array($this->pageData) || count($this->pageData) == 0)
        {
            return '';
        }

        $mainContentData = $this->pageData;

        // die(var_dump($this->pageData));

        $mainContentBuilder = new Builders\MainContentBuilder();
        
        $panelWelcome = $mainContentBuilder->buildElement('div')
                                            ->classList('greeting secondaryBackground w3-panel w3-padding-16')
                                            ->content("<h3>".$mainContentData[0]['welcome']."</h3>")
                                            ->create();

        $imageCard = $mainContentBuilder->createImageCard('resources/BioCantwell.JPG', $mainContentData[4]['b1'], $mainContentData[5]['b2'], $mainContentData[6]['b3']);

        $panel1 = $mainContentBuilder->createPanelContent($mainContentData[2]['p1']);
        $panel2 = $mainContentBuilder->createPanelContent($mainContentData[3]['p2']);
    
        return $mainContentBuilder->createMainContent($panelWelcome.$imageCard.$panel1.$panel2);
    }

    public function animateContent(){
        // $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
    }

}


