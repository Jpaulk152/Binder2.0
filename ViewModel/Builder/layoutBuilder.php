<?php

class layoutBuilder extends htmlBuilder{


    public $homeLayoutClasses = "homeLayout secondaryBackground";

    public function createHomeLayout($content){
        
        $contentContainer = $this->buildElement('div')
                                        ->id('layout')
                                        ->classList($this->homeLayoutClasses)
                                        ->content($content)
                                        ->create();

        return $contentContainer;
    }

}