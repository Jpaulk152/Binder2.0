<?php

namespace Views\Templates;

class Template{

    public $template;
    public $data;

    public function __construct($template, $data)
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function render()
    {
        // die(__DIR__);



        if (!file_exists(__DIR__ . '\\' . $this->template))
        {
            return '<p style="color:red">template not found</p>';
        }

        if (!$this->data)
        {
            return '<p style="color:red">data not found</p>';
        }

        ob_start();
        // extract($this->data);

        $data = $this->data;
        include($this->template);
        return ob_get_clean();
    }
}