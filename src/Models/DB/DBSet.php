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
    protected $generalArray;
    protected $objectArray;

    public function __construct($table, $properties)
    {

        // die(var_dump($properties));

        $this->table = $table;
        $this->model = new stdClass();

        for($i=0;$i<count($properties);$i++)
        {
            $property = $properties[$i];
            $this->model->$property = '';
        }
    }



    // // Set or unset the values of the model
    // function set($values=[])
    // {
    //     foreach($this->model as $property=>$value)
    //     {
    //         if(array_key_exists($property, $values))
    //         {
    //             $this->model->$property = $values[$property];
    //         }
    //         else
    //         {
    //             $this->model->$property = '';
    //         }
    //     }
    // }


    


    // // Runs query of the csv that matches the model's name, 
    // // returns the generalArral of this CSVSet object
    // public function exec()
    // {

    // }


    // // Runs query of the csv that matches the model's name, 
    // // returns the CSVSet object where the generalArray is set to the result of the query
    // public function get()
    // {

    // }



    // function resolveRelation($id)
    // {
    // }



    // // Returns general array with child arrays retrieved
    // function addChildren($parentArray)
    // {
    // }


    // // Returns an array of model objects
    // function toList()
    // {
    //     if (isset($this->generalArray))
    //     {
            

    //         for ($i=0;$i<count($this->generalArray);$i++)
    //         {

    //             $object = new $this->model();

    //             foreach($this->generalArray[$i] as $field=>$value)
    //             {
    //                 $object->$field = $value;
    //             }
    //             $this->objectArray[$i] = $object;


    //             // var_dump($this->objectArray);
    //         }

    //         return $this->objectArray;
    //     }
    //     else
    //     {
    //         throw new \Exception('toList cannot be called before get');
    //     }

        
    // }


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