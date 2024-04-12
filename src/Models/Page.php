<?php

namespace Models;

use Models\DB\Select;
use Models\DB\File;

class Page extends Model
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

    public function get($match=[])
    {
        // $select = new Select();
        // return $select->from('menu.csv')->match($match)->exec();

        $match = [];

        foreach($this as $property=>$value)
        {
            if(!empty($value)){
                $match[$property] = [$value];
            }
        }

        $file = new File('menu.csv');
        $result = $file->from()->match($match)->exec();
        $result = reset($result);

        // die(var_dump($result));

        $pages = array();

        for($i=0;$i<count($result);$i++)
        {
            $page = new Page();
            $page->id = $result[$i]['id'];
            $page->name = $result[$i]['name'];
            $page->title = $result[$i]['title'];
            $page->link = $result[$i]['link'];
            $page->sideContent = $result[$i]['sideContent'];
            $page->mainContent = $result[$i]['mainContent'];
            $page->isLive = $result[$i]['isLive'];
            $page->inMenu = $result[$i]['inMenu'];
            $page->parent = $result[$i]['parent'];

            $pages[$i] = $page;
        }

        if(count($pages) <= 1)
        {
            $pages = reset($pages);
        }
        
        // die(var_dump($pages));

        return $pages;
    }

    public function getAll()
    {
        // $select = new Select();
        // return $select->fetchAll();

        $file = new File('');
        return $file->from('..\src\Models\DB\mockTables\\')->fetchAll();
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