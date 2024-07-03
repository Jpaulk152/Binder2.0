<?php

namespace Controllers;

use Views\Page;

use \utilities as u;

class IndexController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        $this->page = new Page('This is the index page');
        $this->page->title='Index';
    }

    public function index()
    {
        $this->page->render();
    }
    
    function redirect()
    {
        $this->index();

        u::dd('redirected');
    }
}


