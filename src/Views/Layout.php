<?php

namespace Views;

use \utilities as u;

// A collection of Elements type to be displayed as a group
class Layout extends HtmlBuilder{

    public $zones;
    public $classList;

    public function __construct($classList)
    {
        $this->zones = array();
        $this->classList = $classList;
    }

    public function addZone($view=null)
    {
        $zone = new Element('container', 'div');
        if (!is_null($view))
        {
            $zone->content($view->render());
        }

        array_push($this->zones, $zone);

        return $zone;
    }

    public function render()
    {
        $layout = '';

        foreach($this->zones as $zone)
        {
            $layout .= $zone->create();
        }



        return $layout;
    }
}

