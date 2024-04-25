<?php

namespace Views\ViewModels\Builders;

class LayoutBuilder extends HtmlBuilder{


    public $homeLayoutClasses = "homeLayout secondaryBackground";
    public $lessonLayoutClasses = "lessonLayout secondaryBackground";

    public function createHomeLayout($content){
        
        $contentContainer = $this->buildElement('div')
                                        ->id('layout')
                                        ->classList($this->homeLayoutClasses)
                                        ->content($content)
                                        ->create();

        return $contentContainer;
    }

    public function createLessonLayout($content){
        
        $contentContainer = $this->buildElement('div')
                                        ->id('layout')
                                        ->classList($this->lessonLayoutClasses)
                                        ->content($content)
                                        ->create();

        return $contentContainer;
    }

}