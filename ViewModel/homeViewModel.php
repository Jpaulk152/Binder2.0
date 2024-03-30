<?php

    class homeViewModel extends viewModel{

        public $navBarLinks = array();
        public $sideBarLinks = array();
        public $mainContentData = array();

        public $getData = true;
        public $renderNavBar = true;
        public $renderSideBar = false;
        public $renderMainContent = true;
        public $renderLayout = true;

        public $navBar = '';
        public $sideBar = '';
        public $mainContent = '';
        public $layout = '';
        
        function __construct()
        {

            if ($this->getData){

                $this->navBarLinks  = $this->getData('navLinks');
                // $this->sideBarLinks  = $this->getData('sideBarLinks');
                $this->mainContentData  = $this->getData('mainContent');

            }
            if ($this->renderNavBar){
                $this->navBar = $this->renderNavBar();
            }
            if ($this->renderSideBar){
                $this->sideBar = $this->renderSideBar().$this->animateContent();
            }
            if ($this->renderMainContent){
                if ($this->renderSideBar){
                    $this->mainContent = $this->renderMainContent().$this->animateContent();
                }
                else{
                    $this->mainContent = $this->renderMainContent();
                }
            }
            if ($this->renderLayout){
                $this->layout = $this->renderLayout($this->navBar.$this->sideBar.$this->mainContent);
            }
     
        }

        public function getData($table){

            // Error handle the db connection
            $select = new select();

            // Sanitize and Validate Data
            return $select->from($table);
        }

        public function renderMainContent()
        {
            $mainContentBuilder = new mainContentBuilder();

            $panelWelcome = $mainContentBuilder->buildElement('div')
                                               ->classList('greeting secondaryBackground w3-panel w3-padding-16')
                                               ->content("<h3>".$this->mainContentData['welcome']."</h3>")
                                               ->create();

            $imageCard = $mainContentBuilder->createImageCard($this->mainContentData['imagePath'], $this->mainContentData['b1'], $this->mainContentData['b2'], $this->mainContentData['b3']);

            $panel1 = $mainContentBuilder->createPanelContent($this->mainContentData['p1']);
            $panel2 = $mainContentBuilder->createPanelContent($this->mainContentData['p2']);
        
            $mainContent = $mainContentBuilder->createMainContent($panelWelcome.$imageCard.$panel1.$panel2);
            
            return $mainContent;
        }


        public function renderNavBar()
        {
            $navBarBuilder = new navBarBuilder();

            $navBar = $navBarBuilder->createNavBar($this->navBarLinks, 'resources/logo.png');
            
            return $navBar;
        }


        public function renderSideBar()
        {
            $sideBarBuilder = new sideBarBuilder();

            $sideBar = $sideBarBuilder->createSideBar($this->sideBarLinks);

            return $sideBar;
        }


        public function renderLayout($content){
            $containerBuilder = new layoutBuilder();

            $layout = $containerBuilder->createHomeLayout($content);

            return $layout;
        }


        public function animateContent(){
            return '<script type="text/javascript">mainContentShiftRight()</script>';
        }

    }

  


