<?php

namespace ViewModels;

use ViewModels\Builders\HtmlBuilder;

class MainViewModel extends HtmlBuilder implements ViewModel{

    // use Builders\ClassList;

    public $pageData;
    public $tabIndex;
    public $content;

    public function __construct($pageData, &$tabIndex=1)
    {
        // TODO: error handle if pageData not array
        $this->pageData = $pageData;
        $this->tabIndex = &$tabIndex;
    }

    public function render($classList)
    {
        return $this->renderMainContent();
    }

    public function renderMainContent()
    {

        // die(var_dump($this->pageData));

        $mainContentBuilder = new Builders\MainContentBuilder();
        $this->content = '';

        foreach($this->pageData as $element)
        {
            switch ($element['type'])
            {
                case 'h3':
                    $this->content .= $mainContentBuilder->buildElement('div')
                                                        ->classList('greeting secondaryBackground w3-panel w3-padding-16')
                                                        ->content("<h3>".$element['content']."</h3>")
                                                        ->create();
                    break;
                case 'image_card':
                    $this->content .= $mainContentBuilder->createImageCard($element['thing'], $element['thing1'], $element['thing2'], $element['thing3']);
                    break;
                case 'panel':
                    $this->content .= $mainContentBuilder->createPanelContent($element['content']);
                    break;
                case 'img':
                    $this->content .= $mainContentBuilder->createImageContent($element['content']);
                    break;
                case 'h4':
                        
                    $this->content .= $this->buildElement('div')
                                             ->classList('bioInfo w3-container')
                                             ->content('<h4><b>'.$element['content'].'</b></h4>')
                                             ->create();

                    break;
                default:
                    
            }
        }

        return $mainContentBuilder->createMainContent($this->content);


        // if (!is_array($this->pageData) || count($this->pageData) == 0)
        // {
        //     return '';
        // }

        // $mainContentData = $this->pageData;

        // // die(var_dump($this->pageData));

        // $mainContentBuilder = new Builders\MainContentBuilder();
        
        // $panelWelcome = $mainContentBuilder->buildElement('div')
        //                                     ->classList('greeting secondaryBackground w3-panel w3-padding-16')
        //                                     ->content("<h3>".$mainContentData[0]['welcome']."</h3>")
        //                                     ->create();

        // $imageCard = $mainContentBuilder->createImageCard('resources/BioCantwell.JPG', $mainContentData[4]['b1'], $mainContentData[5]['b2'], $mainContentData[6]['b3']);

        // $panel1 = $mainContentBuilder->createPanelContent($mainContentData[2]['p1']);
        // $panel2 = $mainContentBuilder->createPanelContent($mainContentData[3]['p2']);
    
        // return $mainContentBuilder->createMainContent($panelWelcome.$imageCard.$panel1.$panel2);
    }

    public function animateContent(){
        // $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
    }

}


