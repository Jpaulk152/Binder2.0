<?php

namespace Models\DB;

use Models\Page;
use Models\Element;
use Models\Content;
use Models\ClassList;
use Models\Renders;

#[\AllowDynamicProperties]
class CSVContext
{

    protected $path='..\src\Models\DB\Tables\\';

    public function __construct()
    {
        $this->Pages = new CSVSet(new Page);
        $this->Elements = new CSVSet(new Element);
        $this->Content = new CSVSet(new Content);
        $this->ClassLists = new CSVSet(new ClassList);
        $this->Renders = new CSVSet(new Renders);
    }

    public $Pages;
    public $Elements;
    public $Content;
    public $ClassLists;
    public $Renders;

}