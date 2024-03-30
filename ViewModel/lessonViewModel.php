<?php

    // require "Builder/htmlBuilder.php";
    // require "Builder/navBarBuilder.php";
    // require "Builder/sideBarBuilder.php";
    // require "Builder/mainContentBuilder.php";
    // require "Builder/layoutBuilder.php";

    // require "viewModel.php";

    // require "../Model/select.php";

    class lessonViewModel extends viewModel{

        public $navBarLinks = array();
        public $sideBarLinks = array();
        public $mainContentData = array();

        public $getData = true;
        public $renderNavBar = true;
        public $renderSideBar = true;
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
                $this->sideBarLinks  = $this->getData('sideBarLinks');
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
        
            $mainContent = $mainContentBuilder->createMainContent();

            return $mainContent;
        }

        public function renderNavBar()
        {
            $navBarBuilder = new navBarBuilder();

            $navBar = $navBarBuilder->createNavBar($this->navBarLinks, '../resources/logo.png');
            return $navBar;
        }

        public function renderSideBar()
        {
            $sideBarBuilder = new sideBarBuilder();

            $sideBar = $sideBarBuilder->createSideBar($this->sideBarLinks);

            return $sideBar;
        }

        public function renderLayout($content){
            $layoutBuilder = new layoutBuilder();

            $layout = $layoutBuilder->createHomeLayout($content);

            return $layout;
        }


        public function animateContent(){
            return '<script type="text/javascript">mainContentShiftRight()</script>';
        }

    }


