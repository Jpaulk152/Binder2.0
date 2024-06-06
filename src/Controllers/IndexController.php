<?php

namespace Controllers;

use Views\Page;
use Views\Layouts\DefaultLayout;
use Views\Layouts\TestLayout;
use Views\View;


use \utilities as u;

class IndexController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $home = new HomeController();
        $home->index();
    }

    function info()
    {
        phpinfo();
    }

    function redirect($uri)
    {
        $this->page->content = '<p style="color:red">No route found for URI: ' . $uri . '</p>';
        $this->index();
    }
}