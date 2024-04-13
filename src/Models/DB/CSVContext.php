<?php

namespace Models\DB;

use Models\Page;
use Models\Content;

class CSVContext
{

    protected $path='..\src\Models\DB\mockTables\\';

    public function __construct()
    {
        $this->Pages = new CSVSet(new Page);
        $this->Content = new CSVSet(new Content);
    }

    public $Pages;

    public $Content;

}