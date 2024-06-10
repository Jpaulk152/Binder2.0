<?php

namespace Views;

use \utilities as u;

// A collection of Views to be displayed in one content area.
class Layout extends View{

    // public string $id;
    public array $views = [];

    public function __construct(string $id, array $views, array $attributes=[], string $tagName='div')
    {
        $this->id = $id;
        $this->attributes = $attributes;
        $this->tagName = $tagName;
        if (!isset($this->bundle))
        {
            $this->bundle = [];
        }

        $this->addViews($views);
        $this->createLayout();
    }

    protected function createLayout() : void
    {
        $layout = '';
        foreach($this->views as $view)
        {
            $layout .= $view->create();
        }
        parent::__construct($this->id, $layout, $this->attributes, $this->tagName);
    }

    protected function addView(View $view) : void
    {
        $this->views[$view->id] = $view;
        $this->addBundle($view->bundle);
    }

    protected function addViews(array $views) : void
    {
        foreach($views as $view)
        {
            $this->addView($view);
        }
    }

    public function setView(View $view) : void
    {

        $this->addView($view);
        // echo '<body></body>';
        // u::dd($this->views['main']);
        $this->createLayout();
    }
}

