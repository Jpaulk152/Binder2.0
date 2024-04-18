<?php

namespace Models\DB;

use ReflectionClass;

// A CSVSet should be included as a property of a CSVContext
// It expects a Model class that exists in a CSV file that is within the path included in the CSVContext
class DBSet  {

    protected $model;
    protected $generalArray;
    protected $objectArray;

    public function __construct($model)
    {

    }



    // Set or unset the values of the model
    function set($values=[])
    {

    }


    // Runs query of the csv that matches the model's name, 
    // returns the generalArral of this CSVSet object
    public function exec()
    {

    }


    // Runs query of the csv that matches the model's name, 
    // returns the CSVSet object where the generalArray is set to the result of the query
    public function get()
    {

    }



    function resolveRelation($id)
    {
    }



    // Returns general array with child arrays retrieved
    function addChildren($parentArray)
    {
    }


    // Returns an array of model objects
    function toList()
    {
        if (isset($this->generalArray))
        {
            

            for ($i=0;$i<count($this->generalArray);$i++)
            {

                $object = new $this->model();

                foreach($this->generalArray[$i] as $field=>$value)
                {
                    $object->$field = $value;
                }
                $this->objectArray[$i] = $object;


                // var_dump($this->objectArray);
            }

            return $this->objectArray;
        }
        else
        {
            throw new \Exception('toList cannot be called before get');
        }

        
    }


    // Returns the first or default object received
    function firstOrDefault()
    {
        if (isset($this->generalArray))
        {
            $object = new $this->model();

            foreach($this->generalArray[0] as $field=>$value)
            {
                $object->$field = $value;
            }
            
            return $object;
        }
        else
        {
            throw new \Exception('toList cannot be called before exec');
        }
    }


    function CSVtoArray($file)
    {
        $rows = array();
        $rowAdd = true;
        $index = 1;
        $open = $file->openFile('r');
        $header = $open->fgetcsv();
        
        while($indexRow = $open->fgetcsv())
        {

            if((isset($indexRow[0]) && \strpos($indexRow[0], '#') !== false) || !isset($indexRow[0]))
            {
                continue;
            }


            $row = array();
            for($i=0;$i<count($header);$i++)
            {
                $headerField = $this->validate($i, $header);
                $rowField = $this->validate($i, $indexRow);

                if(!empty($this->model->$headerField) && $this->model->$headerField != $rowField)
                {
                    $rowAdd = false;
                }

                $row[$headerField] = $rowField;
            }


            if($rowAdd)
            {
                array_push($rows, $row);
            }
            
            $rowAdd = true;
            $index++;
        }

        return $rows;
    }



    
    public function fetchAll(){

    }

    


    function validate($key, $array)
    {
        if(array_key_exists($key, $array) && isset($array[$key]) && !empty($array[$key]))
        {
            return $array[$key];
        }
        else
        {
            return '<p style="color: red">missing_field</p>';
        }
    }


}