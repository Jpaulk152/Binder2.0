<?php

namespace Views\ViewModels\Builders;

class HtmlBuilder {

    public $element;

    public $elementName;
    public $id;
    public $classList;
    public $style;
    public $tabindex;
    public $href;
    public $onclick;
    public $src;
    public $alt;
    public $width;
    public $height;
    public $content;

    public function buildElement($elementName){

        $this->elementName = $elementName;
        $this->id = false;
        $this->classList = false;
        $this->style = false;
        $this->tabindex = false;
        $this->href = false;
        $this->onclick = false;
        $this->src = false;
        $this->alt = false;
        $this->width = false;
        $this->height = false;
        $this->content = false;

        return $this;
    }

    public function id($id){
        $this->id = $id;
        return $this;
    }

    public function classList($classList){
        $this->classList = $classList;
        return $this;
    }

    public function style($style){
        $this->style = $style;
        return $this;
    }


    public function tabindex($tabindex){
        $this->tabindex = $tabindex;
        return $this;
    }

    public function href($href){
        $this->href = $href;
        return $this;
    }
    
    public function onclick($onclick){
        $this->onclick = $onclick;     
        return $this;
    }

    public function src($src){
        $this->src = $src;
        return $this;
    }

    public function alt($alt){
        $this->alt = $alt;
        return $this;
    }

    public function width($width){
        $this->width = $width;
        return $this;
    }

    public function height($height){
        $this->height = $height;      
        return $this;
    }


    public function content($content){
        $this->content = $content;        
        return $this;
    }


    public function create(){

        $attributes = array(

            0 => ($this->id ? ' id="'.$this->id.'"' : ''),
            1 => ($this->classList ? ' class="'.$this->classList.'"' : ''),
            2 => ($this->style ? ' style="'.$this->style.'"' : ''),
            3 => ($this->tabindex ? ' tabindex="'.$this->tabindex.'"' : ''),
            4 => ($this->href ? ' href="'.$this->href.'"' : ''),
            5 => ($this->onclick ? ' onclick="'.$this->onclick.'"' : ''),
            6 => ($this->src ? ' src="'.$this->src.'"' : ''),
            7 => ($this->alt ? ' alt="'.$this->alt.'"' : ''),
            8 => ($this->width ? ' width="'.$this->width.'"' : ''),
            9 => ($this->height ? ' height="'.$this->height.'"' : ''),

        );

        $this->element = '<' . $this->elementName;
        foreach ($attributes as $a){
            $this->element .= ' ' . $a;
        }

        $this->element .= '>' . ($this->content ? $this->content : '') . '</' . $this->elementName . '>';

        return $this->element;
    }

}




