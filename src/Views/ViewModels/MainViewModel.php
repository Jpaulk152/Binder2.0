<?php

namespace Views\ViewModels;

use Views\ViewModels\Builders\HtmlBuilder;

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
                    $this->content .= $mainContentBuilder->createImageCard($element['child1'], $element['child2'], $element['child3'], $element['child4']);
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
                    continue;
            }
        }

        return $mainContentBuilder->createMainContent($this->content);

    }

    public function animateContent(){
        // $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
    }

}


