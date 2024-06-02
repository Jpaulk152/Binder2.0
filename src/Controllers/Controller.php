<?php

namespace Controllers;

// responsible for gathering data and sending it to a view
class Controller
{
    protected $csvContext;
    protected $dbContext;

    public function __construct()
    {
        $this->csvContext = $GLOBALS['_csvContext'];
        $this->dbContext = $GLOBALS['_dbContext'];
    }



    function addView($view, $dbSet)
    {
        $dbSet->set($view['parameters']);

        $childView['data'] = $dbSet->get()->fields($view['fields'])->objects();
        $childView['data'] = $this->addChildren($childView['data'], $dbSet, $view['primaryKey'], $view['foreignKey'], $view['fields']);
        $childView['classes'] = $this->getClasses($view['classes']);

        return $childView;
    }


    public function getClasses($view)
    {
        $context = $this->csvContext;
        $context->ClassList->set(['view'=>$view]);
        return $context->ClassList->exec();
    }


    public function getChildren($data, $view)
    {
        $context = $this->csvContext;
        $context->Pages->set(['title' => $data]);
        $children['data'] = $context->Pages->get()->objects();
        $children['data'] = $this->addChildren($children['data'], $context->Pages);

        $context->ClassList->set(['view'=>$view]);
        $children['classes'] = $context->ClassList->exec();

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

            $result = $dbSet->resolveRelation([$foreignKey => $parent->$primaryKey]);
            if(!$result){continue;}


            $children = $result->fields($fields)->objects();
            if(empty($children)) {return $parents;}

            
            $children = $this->addChildren($children, $dbSet, $primaryKey, $foreignKey, $fields);
            $parent->children = $children;    

        }

        return $parents;
    }



    public function create($name, \stdClass $entity)
    {
        $affectedRows = $this->dbContext->$name->insert($entity);
        return $affectedRows();
    }

    public function read(string $controller='hc', string $function='menu', array $targets=['view2', 'view3'], array $parameters=[])
    {
        // $targets = '{0: `view2`, 1: `view3`}';

        $t = '{';
        for($i=0;$i<count($targets);$i++)
        {
            $t .= $i.': `'.$targets[$i].'`,';
        }
        $targets = $t.'}';

        $p = '{';
        for($i=0;$i<count($parameters);$i++)
        {
            $p .= $i.': `'.$parameters[$i].'`,';
        }
        $parameters = $p.'}';

        $link = 'javascript:api(`'.$controller.'`, `'.$function.'`, '.$targets.', '.$parameters.')';

        return $link;
        
        // for ($i=0;$i<count($navItems); $i++)
        // {
        //     // $filter = '{page_parent: `'.$navItems[$i]->page_id.'`, page_status: `true`, page_inmenu: `true`}';
        //     $parameters = '{id: `'.$navItems[$i]->page_id.'`}';
        //     // $params = '{id: `'.$navItems[$i]->page_id.'`}, `menu`, `view2`';
        //     $nav[$i] = (object)array('name'=>$navItems[$i]->page_title, 'link'=>'javascript:api(`'.$controller.'`, `'.$function.'`, '.$targets.', '.$parameters.')');
        // }
    }

    public function update($name, $id, $entity)
    {

    }

    public function delete($name, $id)
    {
        
    }

    function toJSON($input)
    {
        return htmlspecialchars(json_encode($input), ENT_QUOTES, 'UTF-8');
    }
    

}