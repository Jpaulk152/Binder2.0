<?php

namespace Models;

use Models\DB\Select;

class File extends Model
{
    public function getFile($name)
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