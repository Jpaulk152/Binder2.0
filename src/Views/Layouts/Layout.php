<?php

namespace Views\Layouts;

use Views\HtmlBuilder;
use Views\Element;
use Views\ViewError;

use \utilities as u;
use Views\View2;

// A collection of Elements type to be displayed as a group
class Layout extends HtmlBuilder{

    public $views = array();
    public $layoutClass = '';

    public function setView($name, $view=null)
    {
        // die(var_dump(is_string($view)));
        // die(var_dump(is_a($view, 'Views\View2')));
        // echo '<body></body>';
        // u::dd(is_a($view, 'View2'));

        $content = '';
        if (is_a($view, 'Views\View'))
        {
            $content = $view->render();
        }
        else if (is_string($view))
        {
            $content = $view;
        }
        else if (is_null($view))
        {
            $content = '';
        }
        else
        {
            new ViewError('setView passed improper type for view.');
        }

        if (array_key_exists($name, $this->views))
        {
            $this->views[$name]->content($content);
        }
        else
        {
            $div = $this->build('div')->content($content);
            $this->views[$name] = $div;
        }

        return $this->views[$name];
    }

    public function render()
    {
        if (empty($this->views))
        {
            new ViewError('No views provided to layout.');
        }

        $content = '';
        foreach($this->views as $view)
        {
            $content .= $view->create();
        }

        $layout = $this->build('div')
                        ->attr('class', $this->layoutClass)
                        ->content($content)
                        ->create();

        return $layout;
    }
}

