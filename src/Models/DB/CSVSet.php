<?php

namespace Models\DB;

use ReflectionClass;

// A CSVSet should be included as a property of a CSVContext
// It expects a Model class that exists in a CSV file that is within the path included in the CSVContext
class CSVSet extends CSVContext {

    protected $model;
    protected $csv;
    protected $generalArray;
    protected $objectArray;
    protected $subPath = 'Primary\\';

    public function __construct($model)
    {
        
        $this->model = $model;

        $reflect = new ReflectionClass($this->model);
        $this->csv = $reflect->getShortName() . '.csv';
    }



    // Set or unset the values of the model
    function set($values=[])
    {
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
    // returns the generalArral of this CSVSet object
    public function exec()
    {
        $array = $this->get()->generalArray;

        $this->generalArray = null;

        return $array;
    }


    // Runs query of the csv that matches the model's name, 
    // returns the CSVSet object where the generalArray is set to the result of the query
    public function get()
    {
        $it = new \RecursiveDirectoryIterator($this->path . $this->subPath);

        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv' && $file->getFileName() == $this->csv) {

                $this->generalArray = $this->CSVtoArray($file);
            } 
        }


        // reset model to all properties='';
        $this->set();

        return $this;
    }



    function resolveRelation($id)
    {
        $this->set(['id'=>$id]);
        return $this->get()->firstOrDefault();
    }



    // Returns general array with child arrays retrieved
    function addChildren($parentArray)
    {
        if (isset($parentArray))
        {
            for($i=0;$i<count($parentArray);$i++)
            {
                $this->set(['parent'=>$parentArray[$i]['id']]);
                // $array[$i]['submenu'] = $this->exec();
                $child = $this->exec();

                // var_dump($child);

                if(count($child) > 0)
                {
                    $child = $this->addChildren($child);
                    $parentArray[$i]['child'] = $child;
                }
            }

            return $parentArray;
        }
        else
        {
            throw new \Exception('addChildren cannot be called before get');
        }
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
        $tables = array();
        $tableName = '';

        $it = new \RecursiveDirectoryIterator($this->path);

        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv' && $file->getFileName() == $this->csv) {

                $tableName = $file->getPath() . '\\' . $file->getFileName();

                $tables[$tableName] = $this->CSVtoArray($file);
            } 
        }

        if(count($tables) > 0)
        {
             return $tables;
        }
        else
        {
            return false;
        }
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