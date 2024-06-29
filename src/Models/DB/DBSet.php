<?php

namespace Models\DB;

use \stdClass;
use Models\Entity;
use \utilities as u;


// A DBSet is included as a property of a DBContext
class DBSet extends DBContext {

    public string $table;
    protected stdClass $model;

    protected array $array;

    protected array $properties;
    protected array $cache;

    public int $iter = 0;

    protected $orderBy;

    public function __construct($table, $properties)
    {
        $this->table = $table;
        $this->array = [];
        $this->properties = $properties;
        $this->cache = [];

        $this->model = new stdClass();

        for($i=0;$i<count($properties);$i++)
        {
            $property = $properties[$i];
            $this->model->$property = '';
        }
    }


    // Set or unset the values of the model
    function set($values=[])
    {
        $this->purgeSet();

        foreach($this->model as $property=>$value)
        {
            if(array_key_exists($property, $values) && !empty($values[$property]))
            {
                $this->model->$property = $values[$property];
            }
            else
            {
                $this->model->$property = '';
            }
        }

        return $this;
    }




    // CREATE #############################################################################

    public function new($values=[], $setPK=false)
    {
        $this->purgeSet();

        $newModel = clone $this->model;

        $pk = $this->getPrimaryKey();
        if (!$setPK)
        {
            if($pk && array_key_exists($pk, $values))
            {
                throw new \Exception('function: new, '.$pk.' is a Primary Key.');
            }
            
            unset($newModel->$pk);
        }

        if(!empty($values))
        {
            foreach($newModel as $property=>$value)
            {
                if(array_key_exists($property, $values) && !empty($values[$property]))
                {
                    $newModel->$property = $values[$property];
                }
                else
                {
                    $newModel->$property = '';
                }
            }
        }

        return $newModel;
    }


    public function insert($object, $setPK=false)
    {
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(', ', array_keys((array)$object)) . ') VALUES ("' . implode('", "', (array)$object) . '");';

        $affectedRows = $this->query($query)->affectedRows();

        return $affectedRows;
    }

    
    // READ ###############################################################################
    public function get(?array $fields=null, $callback=null) : DBSet
    {
        $callback = null;
        $query = $this->buildSelect($fields);


        if(!$query)
        {
            return $this;
        }

        call_user_func_array([$this, 'query'], $query)->fetchAll($callback);

		return $this;
    }


    // returns dbSet with objects based on foreign key relation, if any
    public function with(DBSet $dbSet, string $as, array $relations, ?array $fields=null, ?array $orderBy=null, bool $recursive=false) : DBSet
    {
        if (empty($this->array))
        {
            return $this;
        }
        $dbSet = new DBSet($dbSet->table, $dbSet->properties);

        foreach ($this->array as &$row)
        {
            $relation = [];
            foreach($relations as $key=>$value)
            {
                $relation[$key] = $row[$value];
            }

            $result = $dbSet->set($relation)->orderBy($orderBy)->get($fields);
            if (!empty($result->array))
            {
                if ($recursive)
                {
                    $row[$as] = $result->with($dbSet, $as, $relations, $fields, $orderBy, $recursive)->toArray();
                }
                else
                {
                    $row[$as] = $result->toArray();
                }
            }
        }
        return $this;
    }


    public function getProperties()
    {
        $this->purgeSet();
        return clone $this->model;
    }


    public function toArray(string $class=null) : array
    {
        $array = array_values($this->array);
        if(!is_null($class))
        {
            foreach($array as &$row)
            {
                $row = new $class(...$row);
            }
        }
        return $array;
    }

    // Returns the first or default object received
    function firstOrDefault()
    {
        if (!empty($this->array))
        {            
            $object = $this->array[0];
            $this->purgeSet();
            return $object;
        }
        else
        {
            return false;
        }
    }

    // protected function toEntities()
    // {
    //     $pk = $this->getPrimaryKey();
    //     $table = $this->table;

    //     foreach($this->array as &$row)
    //     {
    //         $fields = array_values($row);

    //         $properties = ['id'=>$fields[0], 'name'=>$fields[1], 'table'=>$table, 'primaryKey'=>$pk];
    //         $entity = new Entity($properties);
            
    //         foreach($row as $key=>$value)
    //         {
    //             $entity->$key = $value;
    //         }

    //         $row = $entity;
    //     }

    //     return $this->array;
    // }


    // override parent fetchAll function
    public function fetchAll($callback = null) : array
    {
        if ($this->query == null)
        {
            $this->query('SELECT * FROM ' . $this->table);
        }

        $this->array = parent::fetchAll($callback);

        return $this->array;
    }







 


    public function numRows() {

        if (!empty($this->entities))
        {
            return count($this->entities);
        }
        else
        {
            return 0;
        }

	}


	public function affectedRows() {

        if ($this->query == null)
        {
            $this->query('SELECT * FROM ' . $this->table);
        }

        $result = parent::affectedRows();
		return $result;
	}


	public function columnNames($table = null) {

        if($table == null)
        {
            $table = $this->table;
        }

        $resultArray = parent::columnNames($table);

		return $resultArray;
	}


	public function table($table = null) {

        if($table == null)
        {
            $table = $this->table;
        }

        $resultArray = parent::table($table);

		return $resultArray;
	}


	public function getPrimaryKey($table = null) {

        if($table == null)
        {
            $table = $this->table;
        }

        $key = parent::getPrimaryKey($table);

		return $key;
	}


    public function orderBy(?array $fields, bool $acending=true) : DBSet
    {
        if(is_null($fields))
        {
            return $this;
        }

        $properties = array_keys(get_object_vars($this->model));
        $orderBy = ' ORDER BY ';
        if(is_array($fields))
        {
            foreach($fields as $field)
            {
                if(!in_array($field, $properties))
                {
                    throw new \Exception('function: orderBy; the table: ['.$this->table.'] has no field: ['.$field.']');
                }
            }

            
            for($i=0;$i<count($fields);$i++)
            {  
                $orderBy .= $fields[$i];
                if ($i+1<count($fields))
                {    
                    $orderBy .= ', ';   
                }
            }
        }
        else
        {
            if(!in_array($fields, $properties))
            {
                throw new \Exception('function: orderBy; the table: ['.$this->table.'] has no field: ['.$fields.']');
            }
            else
            {
                $orderBy .= $fields;
            }
        }

        if (!$acending)
        {
            $orderBy .= ' DESC';
        }

        $this->orderBy = $orderBy;

        return $this;
    }


    // builds a select statment based on set model fields
    function buildSelect(array $getFields=null) : array
    {
        // create the SELECT and FROM clause
        if(!is_null($getFields) && !empty($getFields))
        {
            if (!is_array($getFields))
            {
                throw new \Exception('function: buildSelect passed optional parameter that is not an array.');
            }

            $query[0] = 'SELECT '.implode(', ', $getFields).' FROM ' . $this->table;
        }
        else
        {
            $query[0] = 'SELECT * FROM ' . $this->table;
        }

        // then create the WHERE clause
        $properties = get_object_vars($this->model);
        $fields = array();
        $values = array();

        // u::dd($properties, true, 'props');
        // u::dd($getFields,true);

        $i=0;
        foreach($properties as $property=>$value)
        {
            
            // if property of model has a value
            if($value != '')
            {

                // u::dd($value,true, $i. ' value');
                // u::dd($property,true, $i. ' property');

                $fields[$i] = $property;
                $values[$i] = $value;
                $i++;
            }
        }

        // u::dd($fields,true, 'fields');

        if(!$fields)
        {
            return $query;
        }

        $query[0] .= ' WHERE ';
        for ($i=0;$i<count($fields);$i++)
        {
            $query[0] .= $fields[$i] . ' = ? ';

            if ($i+1<count($fields) && $values[$i+1] != '')
            {    
                $query[0] .= 'AND ';   
            }
            $query[$i+1] = $values[$i];
        }

        // create ORDER BY clause if it exists
        if($this->orderBy != null)
        {
            $query[0] .= $this->orderBy;
        }

        $query[0] .= ';';

        // u::dd($query,true);

        return $query;
    }



    function buildUpdate()
    {

    }


    function purgeSet() : void
    {
        $this->array = [];
        $this->entities = [];
        $this->orderBy = null;

        foreach($this->model as &$property)
        {
            $property = '';
        }
    }
}