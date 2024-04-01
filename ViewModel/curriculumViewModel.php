<?php

    class curriculumViewModel extends viewModel{

        public $navBar = '';
        public $layout = '';
        public $page = '';

        public function getData($table){

            // Error handle the db connection
            $select = new \select();

            // Sanitize and Validate Data
            return $select->from($table);
        }

        public function renderMainContent()
        {
            $mainContentData = $this->getData('mainContent');
            $mainContentBuilder = new mainContentBuilder();

            $mainContent = $mainContentBuilder->createMainContent();

            return $mainContent;
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
            $this->layout = $layoutBuilder->createHomeLayout($this->renderNavBar() . $this->renderSideBar() . $this->renderMainContent());

            $this->page .= $this->layout;
        }


        public function animateContent(){
            $this->page .= '<script type="text/javascript">mainContentShiftRight()</script>';
        }

    }


