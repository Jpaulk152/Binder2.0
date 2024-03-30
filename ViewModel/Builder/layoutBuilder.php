<?php

class layoutBuilder extends htmlBuilder{


    public $homeLayoutClasses = "homeLayout secondaryBackground";

    public function createHomeLayout($content){
        
        $contentContainer = $this->buildElement('div')
                                        ->classList($this->homeLayoutClasses)
                                        ->content($content)
                                        ->create();

        return $contentContainer;
    }

}