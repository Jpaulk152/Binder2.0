<?php

abstract class viewModel
{

    abstract public function getData($table);

    abstract public function renderNavBar();

    abstract public function rendersideBar();

    abstract public function renderMainContent();

    abstract public function renderLayout($content);

}