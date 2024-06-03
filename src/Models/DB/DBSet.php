<?php

namespace Models\DB;

use \stdClass;
use \utilities as u;


//Database Class
//Info on this at https://codeshack.io/super-fast-php-mysql-database-class/
/*
	Example:
	function functionName() {
		Global $db;

		$resultVar = $db->query('SELECT * FROM table_name WHERE field1 = ? AND field2 = ?', $var1, $var2)->fetchArray();
		if($resultVar) return $resultVar;

		return false;
	}
*/


// NOTES:
// method to easily query for number of rows
// 


// A DBSet is included as a property of a DBContext
class DBSet extends DBContext {

    protected $table;
    protected $model;
    protected $properties;
    protected $enumerableArray;
    protected $objectArray;
    protected $cache;


    protected $orderBy;

    public function __construct($table, $properties)
    {
        // parent::__construct();


        $this->table = $table;
        $this->properties = $properties;
        $this->enumerableArray = array();
        $this->objectArray = array();
        $this->cache = array();


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

        // $isValid = false;





        // $pk = $this->getPrimaryKey();
        // if (!$setPK && $pk)
        // {          
        //     unset($newModel->$pk);
        // }

        $query = 'INSERT INTO ' . $this->table . ' (' . implode(', ', array_keys((array)$object)) . ') VALUES ("' . implode('", "', (array)$object) . '");';

        // u::dd($query);


        $affectedRows = $this->query($query)->affectedRows();
        

        // $dbSet = new DBSet($this->table, $this->properties);
        // $dbSet->set((array)$object);

        return $affectedRows;
    }

    
    // READ ###############################################################################
    public function get($fields = [], $callback = null)
    {
        $query = $this->buildSelect($fields);

        if(!$query)
        {
            return $this;
        }

        try
        {
            // $this->enumerableArray = call_user_func_array(array($this, 'query'), $query)->fetchArray();
            $this->enumerableArray = call_user_func_array(array($this, 'query'), $query)->fetchAll($callback);
        }
        catch(\Exception $e)
        {
            // u::dd($e);
        }


        $this->objectArray = $this->enumToObjects($this->enumerableArray);

		return $this;
    }

    public function getProperties()
    {
        $this->purgeSet();
        return clone $this->model;
    }



    public function fieldsArray($keys)
    {
        if(!$keys)
        {
            throw new \Exception('function: fields cannot be called without keys added.');
        }
        if(!$this->objectArray)
        {
            throw new \Exception('function: fields cannot be called before calling get().');
        }

        $rows = array();
        foreach($this->objectArray as $object)
        {  
            $fields = array();
            foreach($keys as $key)
            {
                if(property_exists($object, $key))
                {
                    $fields[$key] = $object->$key;
                }
            }
            array_push($rows, $fields);
        }

        return $rows;
    }

    public function fields($keys)
    {
        if(!$keys)
        {
            throw new \Exception('function: fields cannot be called without keys added.');
        }
        if(!$this->objectArray)
        {
            throw new \Exception('function: fields cannot be called before calling get().');
        }

        $objects = array();
        foreach($this->objectArray as $object)
        {
            $item = new \stdClass();
            foreach($keys as $key)
            {
                if(property_exists($object, $key))
                {
                    $item->$key = $object->$key;
                }
            }
            array_push($objects, $item);
        }
        $this->objectArray = $objects;

        return $this;
    }



    // Returns an array of objects of type $this->model
    function objects($callback=null)
    {

        $objects = array_values($this->objectArray);

        if (!is_null($callback))
        {
            $callback($objects);
        }

        $this->purgeSet();
        return $objects;
    }


    function enumerable()
    {
        if (isset($this->enumerableArray))
        {
            $array = $this->enumerableArray;
            $this->purgeSet();
            return $array;
        }
        else
        {
            throw new \Exception('function: enumerable cannot be called before get()');
        }
    }


    // Returns the first or default object received
    function firstOrDefault()
    {
        // u::dd($this->objectArray);
        if (!empty($this->objectArray))
        {            
            $object = $this->objectArray[0];
            $this->purgeSet();
            return $object;
        }
        else
        {
            return false;
        }
    }

    function children(array $objects, string $foreignKey, array $fields=[], string $orderBy='')
    {
        $getFields = $fields;
        $primaryKey = $this->getPrimaryKey();

        if($primaryKey)
        {
            foreach($objects as $object)
            {
                if (empty($fields))
                {
                    $getFields = array_keys((array)$object);
                }

                if(!isset($object->$primaryKey))
                {
                    // continue;
                    throw new \Exception('Incorrect object provided. Does not have this table\'s primary key', 1);
                }

                $result = $this->resolveRelation([$foreignKey => $object->$primaryKey], $orderBy);
                if(!$result) {continue;}
        
                $children = $result->fields($getFields)->objects();
                if(empty($children)) {continue;}
        
                $children = $this->children($children, $foreignKey, $fields);
                $object->children = $children;
            }
        }
        else
        {
            throw new \Exception('Table does not have a primary key', 1);
        }       

        return $objects;
    }


    // override parent fetchAll function
    public function fetchAll($callback = null) {

        if ($this->query == null)
        {
            $this->query('SELECT * FROM ' . $this->table);
        }

        $this->enumerableArray = parent::fetchAll($callback);
        $this->objectArray = $this->enumToObjects($this->enumerableArray);

		return $this->objectArray;
	}

    public function numRows() {

        // u::dd($this->objectArray);

        if (!empty($this->objectArray))
        {
            return count($this->objectArray);
        }
        else
        {
            return 0;
        }

        // if ($this->query == null)
        // {
        //     $this->query('SELECT * FROM ' . $this->table);
        // }

        // $result = parent::numRows();
		// return $result;
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

    public function orderBy($fields, $acending = true)
    {
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


    // UPDATE #############################################################################


    // DELETE #############################################################################







    // UTILITY ############################################################################


    // Runs query of the csv that matches the model's name, 
    // returns the enumerableArray of this CSVSet object
    public function exec()
    {
        $array = $this->get()->enumerableArray;

        $this->enumerableArray = null;
        $this->set();

        return $array;
    }

    // returns dbSet with objects based on foreign key relation, if any
    function resolveRelation($parameters, string $orderBy = '')
    {
        $dbSet = new DBSet($this->table, $this->properties);
        $dbSet->set($parameters); 

        if (!empty($orderBy))
        {
            $dbSet->orderBy($orderBy);
        }

        if (!$dbSet->get()->objectArray)
        {
            return false;
        }

        return $dbSet;
    }


    function getParent($key, $parameters = [])
    {
        $primaryKey = $this->getPrimaryKey();
        if(!$this->model->$primaryKey)
        {
            return false;
        }
        $dbSet = new DBSet($this->table, $this->properties);
        $value = $dbSet->set([$primaryKey => $this->model->$primaryKey])->get()->fieldsArray([$key])[0][$key];

        $foreignKey = $primaryKey;

        $parameters[$foreignKey] = $value;

        $parentDbSet = $this->resolveRelation($parameters);

        if(!$parentDbSet)
        {
            return false;
        }

        return $parentDbSet;
    }

    function enumToObjects($array)
    {
        $objectArray = array();
        if($array)
        {   
            // fill the objectArray
            for ($i=0;$i<count($array);$i++)
            {
                $object = new $this->model();

                foreach($array[$i] as $field=>$value)
                {
                    $object->$field = $value;
                }
                $objectArray[$i] = $object;
            }            
        }
        return $objectArray;
    }

    function purgeSet()
    {
        $this->enumerableArray = array();
        $this->objectArray = array();
        $this->orderBy = null;

        foreach($this->model as &$property)
        {
            $property = '';
        }
    }

    // builds a select statment based on set model fields
    function buildSelect($getFields)
    {
        // create the SELECT and FROM clause
        if(!empty($getFields))
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
}