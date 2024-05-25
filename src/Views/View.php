<?php

namespace Views;

use \utilities as u;

/**
 *  Template Class 
 *  Expects:
 * 
*              $template:  a path to the template file relative to the location of Template.php
*
*              $data:      must be reference array where the value is either an array of objects or a single object.
*                          [ checking if there are single or multiple is handled by the template file passed ]
*/

class View{

    public $view;
    public $data;
    public $method;

    public function __construct($view, $data, $method='', &$tabIndex=1)
    {
        $this->view = $view;
        $this->data = $data;
        $this->method = $method;
    }

    public function render()
    {
        if (!file_exists(__DIR__ . '\\' . $this->view))
        {
            new ViewError('<p style="color:red">view not found</p>');
        }

        if (!$this->data)
        {
            // new ViewError('<p style="color:red">data not found</p>');
        }

        $method = $this->method;

        ob_start();
        
        if (is_array($this->data))
        {
            foreach($this->data as $name => $entity)
            {
                include($this->view);
            }
        }
        else
        {
            $name = 'entity';
            $entity = $this->data;
            include($this->view);
        }


        return ob_get_clean();
    }
}