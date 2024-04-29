<?php

namespace Models\DB;

use ReflectionClass;
use \stdClass;


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


// A DBSet is included as a property of a DBContext
// #[\AllowDynamicProperties]
class DBSet extends DBContext {

    protected $table;
    protected $model;
    protected $properties;
    protected $enumerableArray;
    protected $objectArray;

    public function __construct($table, $properties)
    {
        // parent::__construct();


        $this->table = $table;
        $this->properties = $properties;

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
        $this->enumerableArray = null;
        $this->objectArray = null;
        $this->enumerableArray = array();
        $this->objectArray = array();

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
    }




    public function get()
    {
       $query = $this->buildSelect();

       if(!$query)
       {
            return $this;
       }

        // $this->enumerableArray = $this->query($query)->fetchArray();
        $this->enumerableArray = $this->query($query)->fetchAll();

		if($this->enumerableArray)
        {   
            // fill the objectArray
            for ($i=0;$i<count($this->enumerableArray);$i++)
            {
                $object = new $this->model();

                foreach($this->enumerableArray[$i] as $field=>$value)
                {
                    $object->$field = $value;
                }
                $this->objectArray[$i] = $object;
            }

            // reset model to all properties=''; still haven't decided to keep this
            // $this->set();
            
        }

		return $this;
    }




    // Runs query of the csv that matches the model's name, 
    // returns the enumerableArray of this CSVSet object
    public function exec()
    {
        $array = $this->get()->enumerableArray;

        $this->enumerableArray = null;
        $this->set();

        return $array;
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
    function objects()
    {
        return array_values($this->objectArray);
    }


    function enumerable()
    {
        if (isset($this->enumerableArray))
        {
            return $this->enumerableArray;
        }
        else
        {
            throw new \Exception('function: enumerable cannot be called before get');
        }
    }


    // Returns the first or default object received
    function firstOrDefault()
    {
        if (isset($this->objectArray))
        {            
            return $this->objectArray[0];
        }
        else
        {
            return false;
        }
    }




    function resolveRelation($value, $foreignKey)
    {
        $dbSet = new DBSet($this->table, $this->properties);
        $dbSet->set([$foreignKey => $value]); 

        if (!$dbSet->get()->objectArray)
        {
            return false;
        }


        return $dbSet;
    }


    

    function buildSelect()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $properties = get_object_vars($this->model);
        $fields = array();
        $values = array();

        $i=0;
        foreach($properties as $property=>$value)
        {
            if($value != '')
            {
                $fields[$i] = $property;
                $values[$i] = $value;
                $i++;
            }
        }

        if(!$fields)
        {
            return false;
        }

        $query .= ' WHERE ';
        for ($i=0;$i<count($fields);$i++)
        {
            $query .= $fields[$i] . '="' . $values[$i] . '" ';

            if ($i+1<count($fields) && $values[$i+1] != '')
            {
                $query .= 'AND ';
            }

        }

        // die($query);

        return $query;
    }


    


    


}