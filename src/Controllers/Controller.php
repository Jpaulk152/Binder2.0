<?php

namespace Controllers;

// responsible for gathering data and sending it to a view
class Controller
{
    use \ViewModels\Builders\ClassList;

    protected $csvContext;
    protected $dbContext;

    public function __construct()
    {
        $this->csvContext = $GLOBALS['_csvContext'];
        $this->dbContext = $GLOBALS['_dbContext'];
    }

    public function getData($mainContent=null, $sideMenu=null, $navMenu='home')
    {
        $pageSet = $this->dbContext->page_table;
        $pageData = ['view'=>'test'];
        $viewModels[0] = $this->viewData($pageSet, $pageData, 'nav');

        $pageData = ['page_status'=>'true', 'page_inmenu'=>'false', 'page_parent'=>'none'];
        $viewModels[1] = $this->viewData($this->dbContext->page_table, $pageData, 'side');
 


        $context = $this->csvContext;

        $context->ClassLists->set(['view'=>'home']);
        
        $layout = $context->ClassLists->get()->firstOrDefault()->list;

        $data['viewModels'] = $viewModels;
        $data['layout'] = $layout;

        return $data;
    }



    
    public function viewData($dbSet, $keys, $view)
    {
        // nav items
        $context = $this->dbContext;
        $dbSet->set($keys);
        $elements = $dbSet->get()->objects();
        $views = null;

        if(!$elements) { return false; }

        foreach($elements as $element)
        {
            $element = $this->addChildren($element, $dbSet);
            if (isset($element->view))
            {
                
                array_push($views[$element->view], $element);
            }
            else
            {
                array_push($views['default'], $element);
            }
        }

        $context = $this->csvContext;
        foreach($views as $viewName => $view)
        {
            $context->ClassLists->set(['view'=>$viewName]);
            $view['classList'] = $context->ClassLists->exec();
        }





        // $elements = $this->addChildren($elements, $dbSet);

        // $menuItems = $this->menuData($elements);

        // nav classlists
        






        // $view = ucfirst($view);
        // $viewModel = ['data' => [$menuItems], 'classes' => $navClasses, 'viewModel' => $view . 'ViewModel'];

        return $views;
    }



    public function menuData($items)
    {
        if(!$items) {return false;}

        $menuItems = array();
        foreach($items as $item)
        {
            $menuItem['name'] = $item->page_title;
            // $menuItem['link'] = '?menu=' . $item->page_id;
            $menuItem['link'] = '#';//$item->page_id;

            if (isset($item->children))
            {
                $menuItem['child'] = $this->menuData($item->children);   
            }

            array_push($menuItems, $menuItem);
        }
        return $menuItems;
    }

    public function addChildren($parents, $dbSet, $primaryKey='id', $foreignKey='parent')
    {
        
        // die(var_dump($parents));
        foreach($parents as &$parent)
        {
            if (gettype($parent) != gettype(\stdClass::class))
            {return $parents;}

            $result = $dbSet->resolveRelation($parent->$primaryKey, $foreignKey);
            if(!$result){return $parents;}


            $children = $dbSet->objects();
            if(!$children) {return $parents;}


            $children = $this->addChildren($children, $dbSet, $primaryKey, $foreignKey);
            $parent->children = $children;    
        }
        return $parents;
    }

}