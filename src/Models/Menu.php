<?php

namespace Models;

use Models\DB\Select;

class Menu extends Model
{
    public function get($name='menu.csv', $match=[])
    {
        $select = new Select();
        return $select->from($name)->match($match)->exec();
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

    public function addSubMenus($menu, $table)
    {
        $menuItems = current($menu);

        $menu = [];
        foreach($menuItems as &$itemFields)
        {
            $parentId = $itemFields['id'];

            $submenu = $this->get($table, ['parent'=>[$parentId]]);

            // var_dump($submenu);

            $itemFields['submenu'] = reset($submenu);
        }
        array_push($menu, $menuItems);

        return $menu;
    }
}