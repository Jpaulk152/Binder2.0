<?php

namespace Models;

use Models\DB\Select;

class Content extends Model
{
    public function get($match=[])
    {
        $select = new Select();
        return $select->from('content.csv')->match($match)->exec();
    }

    public function getAll()
    {
        $select = new Select();
        return $select->fetchAll();
    }

    protected function set($id, $values)
    {

    }

    protected function add($values)
    {

    }

    protected function remove($id)
    {

    }
}

