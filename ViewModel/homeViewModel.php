<?php

    class homeViewModel extends viewModel{

        public $navBar = '';
        public $layout = '';
        public $page = '';

        public function getData($table){

            // Error handle the db connection
            $select = new select();

            // Sanitize and Validate Data
            return $select->from($table);
        }

        public function renderMainContent()
        {
            $mainContentData = $this->getData('mainContent');
            $mainContentBuilder = new mainContentBuilder();

            // $panelWelcome = $mainContentBuilder->buildElement('div')
            //                                    ->classList('greeting secondaryBackground w3-panel w3-padding-16')
            //                                    ->content("<h3>".$mainContentData['welcome']."</h3>")
            //                                    ->create();

            // $imageCard = $mainContentBuilder->createImageCard($mainContentData['imagePath'], $mainContentData['b1'], $mainContentData['b2'], $mainContentData['b3']);

            // $panel1 = $mainContentBuilder->createPanelContent($mainContentData['p1']);
            // $panel2 = $mainContentBuilder->createPanelContent($mainContentData['p2']);


            
            $panelWelcome = $mainContentBuilder->buildElement('div')
                                               ->classList('greeting secondaryBackground w3-panel w3-padding-16')
                                               ->content("<h3>".$mainContentData[0]['welcome']."</h3>")
                                               ->create();

            $imageCard = $mainContentBuilder->createImageCard($mainContentData[1]['imagePath'], $mainContentData[4]['b1'], $mainContentData[5]['b2'], $mainContentData[6]['b3']);

            $panel1 = $mainContentBuilder->createPanelContent($mainContentData[2]['p1']);
            $panel2 = $mainContentBuilder->createPanelContent($mainContentData[3]['p2']);
        
            return $mainContentBuilder->createMainContent($panelWelcome.$imageCard.$panel1.$panel2);
        }

        public function renderSideBar()
        {
            $sideBarLinks = $this->getData('sideBarLinks');
            $sideBarBuilder = new sideBarBuilder();

            return $sideBarBuilder->createSideBar($sideBarLinks);
        }

        public function renderNavBar()
        {
            $navBarLinks = $this->getData('navLinks');
            $navBarBuilder = new navBarBuilder();

            $this->navBar = $navBarBuilder->createNavBar($navBarLinks, 'resources/logo.png');

            return $this->navBar;
        }

        public function renderLayout()
        {
            $layoutBuilder = new layoutBuilder();
            $this->layout = $layoutBuilder->createHomeLayout($this->renderNavBar() . $this->renderMainContent());

            $this->page .= $this->layout;
        }


        public function animateContent(){
            $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
        }

    }

  


