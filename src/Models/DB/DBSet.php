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
class DBSet extends DB {

    protected $table;
    protected $model;
    protected $enumerableArray;
    protected $objectArray;

    public function __construct($table, $properties)
    {
        parent::__construct();

        // die(var_dump($properties));

        $this->table = $table;
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
            if(array_key_exists($property, $values))
            {
                $this->model->$property = $values[$property];
            }
            else
            {
                $this->model->$property = '';
            }
        }
    }



    // Runs query of the csv that matches the model's name, 
    // returns the enumerableArray of this CSVSet object
    public function exec()
    {
        $array = $this->get()->enumerableArray;

        $this->enumerableArray = null;

        return $array;
    }

    

    // Runs query of the csv that matches the model's name, 
    // returns the CSVSet object where the enumerableArray is set to the result of the query
    // public function get()
    // {
    //    $query = $this->buildSelect();

    //     // $this->enumerableArray = $this->query($query)->fetchArray();

    //     $values = $this->query($query)->fetchAll();
        

	// 	if($this->enumerableArray && $values)
    //     {   
    //         array_push($this->enumerableArray, $values);

    //         // fill the objectArray
    //         for ($i=0;$i<count($this->enumerableArray);$i++)
    //         {
    //             $object = new $this->model();

    //             foreach($this->enumerableArray[$i] as $field=>$value)
    //             {
    //                 $object->$field = $value;
    //             }
    //             $this->objectArray[$i] = $object;
    //         }

    //         // reset model to all properties=''; still haven't decided to keep this
    //         $this->set();
    //         return $this;
    //     }
    //     else if($values)
    //     {
    //         $this->enumerableArray = $values;
    //         return $this;
    //     }

	// 	return false;
    // }

    public function get()
    {
       $query = $this->buildSelect();

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
            // return $this;
        }

		return $this;
        
    }



    public function fields($keys=[])
    {
        $rows = array();
        if($keys)
        {
            foreach($this->enumerableArray as $row)
            {
                $fields = array();
                for($i=0;$i<count($keys);$i++)
                {
                    if(array_key_exists($keys[$i], $row))
                    {
                        $fields[$keys[$i]] = $row[$keys[$i]];
                    }
                }
                array_push($rows, $fields);
            }
            return $rows;
        }
        else
        {
            return $this->enumerableArray;
        }
    }




    // Returns an array of objects of type $this->model
    function objects()
    {
        // if (isset($this->objectArray))
        // {
        //     return array_values($this->objectArray);
        // }
        // else
        // {
        //     // throw new \Exception('function: objects cannot be called before get');

        //     return false;

        //     // return array(new $this->model());
        // }
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
            return $query;
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


    
    function resolveRelation($value, $foreignKey)
    {
        $this->set([$foreignKey => $value]);
        return $this->get();
    }



    // Returns general array with child arrays retrieved
    function addChildren($parentArray)
    {


    }


        // // Returns the first or default object received
    // function firstOrDefault()
    // {
    //     if (isset($this->generalArray))
    //     {
    //         $object = new $this->model();

    //         foreach($this->generalArray[0] as $field=>$value)
    //         {
    //             $object->$field = $value;
    //         }
            
    //         return $object;
    //     }
    //     else
    //     {
    //         throw new \Exception('toList cannot be called before exec');
    //     }
    // }


    // function CSVtoArray($file)
    // {
    //     $rows = array();
    //     $rowAdd = true;
    //     $index = 1;
    //     $open = $file->openFile('r');
    //     $header = $open->fgetcsv();
        
    //     while($indexRow = $open->fgetcsv())
    //     {

    //         if((isset($indexRow[0]) && \strpos($indexRow[0], '#') !== false) || !isset($indexRow[0]))
    //         {
    //             continue;
    //         }


    //         $row = array();
    //         for($i=0;$i<count($header);$i++)
    //         {
    //             $headerField = $this->validate($i, $header);
    //             $rowField = $this->validate($i, $indexRow);

    //             if(!empty($this->model->$headerField) && $this->model->$headerField != $rowField)
    //             {
    //                 $rowAdd = false;
    //             }

    //             $row[$headerField] = $rowField;
    //         }


    //         if($rowAdd)
    //         {
    //             array_push($rows, $row);
    //         }
            
    //         $rowAdd = true;
    //         $index++;
    //     }

    //     return $rows;
    // }




    


    // function validate($key, $array)
    // {
    //     if(array_key_exists($key, $array) && isset($array[$key]) && !empty($array[$key]))
    //     {
    //         return $array[$key];
    //     }
    //     else
    //     {
    //         return '<p style="color: red">missing_field</p>';
    //     }
    // }


}