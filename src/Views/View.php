<?php

namespace Views;
use ViewModels\SideViewModel;
use ViewModels\NavViewModel;

use \ViewModels\Builders\HtmlBuilder;


// responsible for displaying data; expects page data and decides how to display it
class View
{

    public $head = null;
    public $title = null;
    public $body = '';
    public $template = null;
    public $data = null;

    public function __construct($data=null, $template=null, $body=null)
    {
        $this->data = $data;
        $this->template = $template;
        $this->body = $body;
    }

    // public function __construct($page)
    // {


    //     $this->data = $data;
    //     $this->template = $template;
    //     $this->body = $body;
    // }

    // interpret data
    function interpretData()
    {

    }


    // decide how to display it



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

        
        if(isset($this->data['content']['data']))
        {   
            $side=false;
            if(isset($this->data['viewModels']))
            {
                for($i=0;$i<count($this->data['viewModels']);$i++)
                {
                    // die(var_dump($this->data));
                    if($this->data['viewModels'][$i]['viewModel'] == 'SideViewModel')
                    {
                        $side = true;
                    }
                }
            }
            if($side)
            {
                $classList = 'mainContentToRight';
            }
            else
            {
                $classList = '';
            }

            $classList .= ' w3-container';

            $mainContent = $htmlBuilder->buildElement('div')
                        ->id('mainContent')
                        ->classList($classList)
                        ->content($this->data['content']['data'])
                        ->create();


            $content .= $mainContent;
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