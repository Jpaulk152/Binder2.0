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
 

        // get sidebar ###############################################
        if(isset($sideMenu))
        {
            $context = $this->csvContext;

            $context->Pages->set(['title' => $sideMenu]);
            $pages = $context->Pages->exec();
            $pages = $context->Pages->addChildren($pages);
            
            $context->ClassLists->set(['view'=>'side']);
            $sideClasses = $context->ClassLists->exec();

            $viewModels[1] = ['data' => [$pages], 'classes' => $sideClasses, 'viewModel' => 'SideViewModel'];
        }

        // get main content #########################################
        if(isset($mainContent))
        {

        }

        $context = $this->csvContext;

        $context->ClassLists->set(['view'=>'home']);
        
        $layout = $context->ClassLists->get()->firstOrDefault()->list;

        $data['viewModels'] = $viewModels;
        $data['layout'] = $layout;

        return $data;
    }



    
    public function viewData($dbSet, $viewData, $viewStyle)
    {
        // nav classlists
        $context = $this->csvContext;
        $context->ClassLists->set(['view'=>$viewStyle]);
        $navClasses = $context->ClassLists->exec();

        // nav items
        $context = $this->dbContext;
        $dbSet->set($viewData);
        $pages = $dbSet->get()->objects();
        $pages = $this->addChildren($pages, $dbSet);

        $menuItems = $this->menuData($pages);

        $viewStyle = ucfirst($viewStyle);

        $viewModel = ['data' => [$menuItems], 'classes' => $navClasses, 'viewModel' => $viewStyle . 'ViewModel'];

        return $viewModel;
    }



    public function menuData($items)
    {
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
        foreach($parents as &$parent)
        {
            $result = $dbSet->resolveRelation($parent->$primaryKey, $foreignKey);
            if($result)
            {
                $children = $dbSet->objects();

                $children = $this->addChildren($children, $dbSet, $primaryKey, $foreignKey);
                $parent->children = $children;                
            }
        }
        return $parents;
    }


    private $sideBarLinks = array(
        
        array("name" => "Regular Accordian", "link" => "#",
            "menuItems" => array(
                array("name" => "PHP Exercise 1", "link" => "javascript:changeContent('../exercisePHP/1/index.php', 'iframe')"),
                array("name" => "PHP Exercise 2", "link" => "javascript:changeContent('../exercisePHP/2/index.html', 'iframe')"),
                array("name" => "PHP Exercise 3", "link" => "javascript:changeContent('../exercisePHP/3/index.html', 'iframe')"),
                array("name" => "PHP Exercise 4", "link" => "javascript:changeContent('../exercisePHP/4/index.html', 'iframe')"),
                array("name" => "PHP Exercise 5", "link" => "javascript:changeContent('../exercisePHP/5/index.php', 'iframe')"),
                array("name" => "PHP Exercise 6", "link" => "javascript:changeContent('../exercisePHP/6/index.php', 'iframe')"),
                array("name" => "PHP Exercise 7", "link" => "javascript:changeContent('../exercisePHP/7/index.php', 'iframe')"),
                )
            ),
    
        array("name" => "Content with no Accordian", "link" => "#")
        );
}