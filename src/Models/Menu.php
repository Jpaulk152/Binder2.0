<?php

namespace Models;

use Models\DB\Select;
use Models\DB\File;

class Menu extends Model
{
    public function get($match=[])
    {
        // $select = new Select();
        // return $select->from('menu.csv')->match($match)->exec();

        $file = new File('menu.csv');
        return $file->from('..\src\Models\DB\mockTables\Primary\\')->match($match)->exec();
    }

    public function getAll()
    {
        // $select = new Select();
        // return $select->fetchAll();

        $file = new File('..\src\Models\DB\mockTables\\');
        return $file->fetchAll();
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

    public function addSubMenus($menu)
    {
        $menuItems = current($menu);

        $completedMenu = [];
        foreach($menuItems as &$itemFields)
        {
            $parentId = $itemFields['id'];

            $menu = $this->get(['parent'=>[$parentId]]);

            if($menu == false)
            {
                var_dump($itemFields);
                $itemFields['submenu'] = [];
            }
            else
            {
                $menu = $this->addSubMenus($menu);
                $itemFields['submenu'] = reset($menu);
            }

           
        }
        array_push($completedMenu, $menuItems);

        return $completedMenu;
    }
}