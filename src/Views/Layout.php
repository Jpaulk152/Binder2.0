<?php

namespace Views;

use \utilities as u;

// A collection of Views to be displayed in one content area.
class Layout extends View{

    // public string $id;
    public array $views = array();

    public function __construct(string $id, array $views, array $attributes=[])
    {
        $this->id = $id;
        $this->attributes = $attributes;

        $this->addViews($views);
        $this->createLayout();
    }

    protected function createLayout()
    {
        $layout = '';
        foreach($this->views as $view)
        {
            $layout .= $view->create();
        }
        parent::__construct($this->id, $layout, $this->attributes);
    }

    protected function addView(View $view)
    {
        $this->views[$view->id] = $view;
    }

    protected function addViews(array $views)
    {
        foreach($views as $view)
        {
            $this->addView($view);
        }
    }

    public function setView(View $view)
    {
        $this->addView($view);
        $this->element = $this->createLayout();
    }
}

