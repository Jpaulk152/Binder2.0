<?php

namespace Controllers;

use \AllowDynamicProperties;

// responsible for gathering data and sending it to a view
class Controller
{
    // use Views\ViewModels\Builders\ClassList;

    protected $csvContext;
    protected $dbContext;

    public function __construct()
    {
        $this->csvContext = $GLOBALS['_csvContext'];
        $this->dbContext = $GLOBALS['_dbContext'];
    }


    public function getChildren($data, $view)
    {
        $context = $this->csvContext;
        $context->Pages->set(['title' => $data]);
        $children['data'] = $context->Pages->get()->objects();
        $children['data'] = $this->addChildren($children['data'], $context->Pages);

        $context->ClassLists->set(['view'=>$view]);
        $children['classes'] = $context->ClassLists->exec();

        return $children;
    }


    public function addChildren($parents, $dbSet, $primaryKey='id', $foreignKey='parent')
    {
        
        // die(var_dump($parents));
        foreach($parents as $parent)
        {
            // if (gettype($parent) != gettype(\stdClass::class))
            // {return $parents;}

            $result = $dbSet->resolveRelation($parent->$primaryKey, $foreignKey);
            if(!$result){return $parents;}

            $children = $dbSet->objects();
            // if(!$children) {return $parents;}
            
            $children = $this->addChildren($children, $dbSet, $primaryKey, $foreignKey);
            $parent->children = $children;    

        }

        return $parents;
    }

}