<?php

namespace Controllers;

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



    function addView($view, $dbSet)
    {
        $dbSet->set($this->$view['set']);

        $childView['data'] = $dbSet->get()->fields($this->$view['fields'])->objects();
        $childView['data'] = $this->addChildren($childView['data'], $dbSet, $this->$view['primaryKey'], $this->$view['foreignKey'], $this->$view['fields']);
        $childView['classes'] = $this->getClasses($view);

        return $childView;
    }


    public function getClasses($view)
    {
        $context = $this->csvContext;
        $context->ClassLists->set(['view'=>$view]);
        return $context->ClassLists->exec();
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


    public function addChildren($parents, $dbSet, $primaryKey='id', $foreignKey='parent', $fields=['name', 'link', 'id'])
    {
        if (!$parents || count($parents) < 1) {return $parents;}

        foreach($parents as $parent)
        {        
            if (!isset($parent->$primaryKey))
            {
                throw new \Exception('Undefined property: ' . gettype($parent) . '::$' . $primaryKey . ' in addChildren function', 1);
            }

            $result = $dbSet->resolveRelation($parent->$primaryKey, $foreignKey);
            if(!$result){continue;}


            $children = $result->fields($fields)->objects();
            if(empty($children)) {return $parents;}

            
            $children = $this->addChildren($children, $dbSet, $primaryKey, $foreignKey, $fields);
            $parent->children = $children;    

        }

        return $parents;
    }

}