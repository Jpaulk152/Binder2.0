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

        $completedMenu = [];
        foreach($menuItems as &$itemFields)
        {
            $parentId = $itemFields['id'];

            $menu = $this->get($table, ['parent'=>[$parentId]]);

            if($menu == false)
            {
                var_dump($itemFields);
                $itemFields['submenu'] = [];
            }
            else
            {
                $menu = $this->addSubMenus($menu, $table);
                $itemFields['submenu'] = reset($menu);
            }

           
        }
        array_push($completedMenu, $menuItems);

        return $completedMenu;
    }
}