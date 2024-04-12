<?php

namespace Views;
use ViewModels\SideViewModel;
use ViewModels\NavViewModel;

use \ViewModels\Builders\HtmlBuilder;


// responsible for displaying data; expects page data and decides how to display it
class View2
{
    public $body = '';
    public $elements = [];

    public $template = null;
    public $data = null;
    public $classes = null;

    public function __construct($data=null)
    {
        $this->data = $data;
    }


    public function render()
    {
        include 'top.php';

        $htmlBuilder = new HtmlBuilder();
        $content = '';
        $tabIndex = 1;

        if(!isset($this->data))
        {
            echo 'no data provided';
            return;
        }

        // expand viewModels with their data and classes
        if(isset($this->data['viewModels']))
        {
            foreach($this->data['viewModels'] as $vm)
            {
                $viewModel = 'ViewModels\\' . $vm['viewModel'];
                $viewModel = new $viewModel(current($vm['data']), $tabIndex);
                $content .= $viewModel->render($vm['classes']);
            } 
        }


        // die(var_dump($this->data));

        // add templates to the mainContent
        if(isset($this->data['template']['page']) && isset($this->data['template']['data']))
        {
            // die('HERE');
            $this->template = new Template($this->data['template']['page'], $this->data['template']['data']);
            $content .= $this->template->render();
        }


        if(isset($this->data['test']['data']))
        {           
            $content .= $this->data['test']['data'];
        }


        if(isset($this->data['layout']))
        {
            $this->body .= $htmlBuilder->buildElement('div')
                                        ->id('layout')
                                        ->classList($this->data['layout'])
                                        ->content($content)
                                        ->create();   
        }
        else
        {
            $this->body .= $content;
        }


        echo $this->body;

        include 'bottom.php';
    }
}




class Template{

    public $page;
    public $data;

    public function __construct($page, $data)
    {
        $this->page = $page;
        $this->data = $data;
    }

    public function render()
    {
        if (!$this->data)
        {
            return 'data not found';
        }

        ob_start();
        extract($this->data);
        include($this->page);
        return ob_get_clean();
    }
}