<?php

namespace Views\Templates;

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

class Template{

    public $template;
    public $data;
    public $method;

    public function __construct($template, $data, $method='')
    {
        $this->template = $template;
        $this->data = $data;
        $this->method = $method;
    }

    public function render()
    {
        if (!file_exists(__DIR__ . '\\' . $this->template))
        {
            return '<p style="color:red">template not found</p>';
        }

        if (!$this->data)
        {
            return '<p style="color:red">data not found</p>';
        }

        $method = $this->method;

        ob_start();        
        foreach($this->data as $name => $entity)
        {
            include($this->template);
        }
        return ob_get_clean();
    }
}