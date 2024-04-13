<?php

namespace Models;

use Models\DB\Select;
use Models\DB\File;

class Page
{
    public $id;
    public $name;
    public $title;
    public $link;
    public $sideContent;
    public $mainContent;
    public $isLive;
    public $inMenu;
    public $parent;
}