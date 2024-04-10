<?php

namespace Controllers;

use Models\Menu;
use Models\Content;

// responsible for gathering data and sending it to a view
class Controller
{
    use \ViewModels\Builders\ClassList;

    public function getData($mainContent=null, $sideMenu=null, $navMenu='home')
    {
        $menu = new Menu();

        // get menu data for top navigation
        $navData = $menu->get(['title' => [$navMenu]]);
        $navData = $menu->addSubMenus($navData);
        $navClasses = $this->navClasses();
        $viewModels[0] = ['data' => $navData, 'classes' => $navClasses, 'viewModel' => 'NavViewModel'];

        if(isset($sideMenu))
        {
            // get menu data for side navigation
            $sideData = $menu->get(['title' => [$sideMenu]]);
            $sideData = $menu->addSubMenus($sideData);
            $sideClasses = $this->sideClasses();
            $viewModels[1] = ['data' => $sideData, 'classes' => $sideClasses, 'viewModel' => 'SideViewModel'];
        }

        if(isset($mainContent))
        {
            $content = new Content();
            
            // get content data for main content area
            $match = ['title' => [$mainContent]];
            $mainData = $content->get($match);
            $mainClasses = $this->mainClasses();
            $viewModels[2] = ['data' => $mainData, 'classes' => $mainClasses, 'viewModel' => 'MainViewModel'];
        }


        // get layout classes
        $layout = $this->layoutClasses()['homeLayout'];

        $data['viewModels'] = $viewModels;
        $data['layout'] = $layout;

        return $data;
    }

}