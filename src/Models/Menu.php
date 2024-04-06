<?php

namespace Models;

use DB\Select;

class Menu extends Model
{
    public function get($name='menu.csv')
    {
        $select = new Select();
        return $select()->from($name);
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