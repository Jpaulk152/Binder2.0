<?php

namespace ViewModels;

abstract class ViewModel
{

    abstract public function getData($table);

    abstract public function renderNavBar();

    abstract public function rendersideBar();

    abstract public function renderMainContent();

    abstract public function renderLayout();

}