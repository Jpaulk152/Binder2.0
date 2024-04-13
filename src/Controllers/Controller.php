<?php

namespace Controllers;

// responsible for gathering data and sending it to a view
class Controller
{
    use \ViewModels\Builders\ClassList;

    protected $context;

    public function __construct()
    {
        $this->context = $GLOBALS['_csvContext'];
    }

    public function getData($mainContent=null, $sideMenu=null, $navMenu='home')
    {
        // get navbar ################################################
        $this->context->Pages->set(['title' => $navMenu]);
        $pages = $this->context->Pages->exec();
        $pages = $this->context->Pages->addChildren($pages);
        $navClasses = $this->navClasses();

        $viewModels[0] = ['data' => [$pages], 'classes' => $navClasses, 'viewModel' => 'NavViewModel'];

        // get sidebar ###############################################
        if(isset($sideMenu))
        {
            $this->context->Pages->set(['title' => $sideMenu]);
            $pages = $this->context->Pages->exec();
            $pages = $this->context->Pages->addChildren($pages);
            $sideClasses = $this->sideClasses();

            $viewModels[1] = ['data' => [$pages], 'classes' => $sideClasses, 'viewModel' => 'SideViewModel'];
        }

        // get main content #########################################
        if(isset($mainContent))
        {
            $this->context->Content->set(['title' => $mainContent]);
            $content = $this->context->Content->exec();
            $mainClasses = $this->mainClasses();
            
            $viewModels[2] = ['data' => [$content], 'classes' => $mainClasses, 'viewModel' => 'MainViewModel'];
        }

        $layout = $this->layoutClasses()['homeLayout'];

        $data['viewModels'] = $viewModels;
        $data['layout'] = $layout;

        return $data;
    }
}