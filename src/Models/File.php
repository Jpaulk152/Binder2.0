<?php

namespace Models;

use Models\DB\Select;

class File extends Model
{
    protected $path = '..\src\Models\DB\mockTables\Primary\\';

    protected $name=null;

    protected $match=null;

    protected $unMatch=null;

    public function get($name)
    {

    }

    public function getAll()
    {
        $select = new Select();
        return $select->fetchAll();
    }

    protected function set()
    {

    }

    protected function add()
    {

    }

    protected function remove()
    {

    }
}