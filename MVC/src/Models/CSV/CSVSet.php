<?php

namespace Models\CSV;

use \stdClass;

// A CSVSet should be included as a property of a CSVContext
// It expects a Model class that exists in a CSV file that is within the path included in the CSVContext
class CSVSet extends CSVContext {

    protected $table;
    protected $model;
    protected $properties;
    protected $csv;
    protected $enumerableArray;
    protected $objectArray;
    protected $subPath = '';

    
    public function __construct($table, $properties)
    {
        // parent::__construct();


        $this->table = $table;
        $this->properties = $properties;
        $this->csv = $this->table . '.csv';

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
    // returns the CSVSet object where the enumerableArray is set to the result of the query
    public function get()
    {
        $it = new \RecursiveDirectoryIterator($this->path . $this->subPath);
        // die($this->csv);
        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv' && $file->getFileName() == $this->csv) {
                // die('HERE');
                $this->enumerableArray = $this->CSVtoArray($file);
            } 
        }

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

        // die(var_dump($this->enumerableArray));

        return $this;
    }


    // Runs query of the csv that matches the model's name, 
    // returns the generalArral of this CSVSet object
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




    function resolveRelation($parameters)
    {
        $csvSet = new CSVSet($this->table, $this->properties);
        $csvSet->set($parameters);

        if (!$csvSet->get()->objectArray)
        {
            return false;
        }

        return $csvSet;
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




    function CSVtoArray($file, $all=false)
    {
        $rows = array();
        $rowAdd = true;
        $index = 1;
        $open = $file->openFile('r');
        $header = $open->fgetcsv();
        
        while($indexRow = $open->fgetcsv())
        {

            

            // checks for comments or newlines and ignores them
            if((isset($indexRow[0]) && \strpos($indexRow[0], '#') !== false) || !isset($indexRow[0]))
            {
                continue;
            }


            // echo var_dump($indexRow) . '<br>';

            $row = array();
            for($i=0;$i<count($header);$i++)
            {
                $headerField = $this->validate($i, $header);
                $rowField = $this->validate($i, $indexRow);

                

                if(!$all && !empty($this->model->$headerField) && $this->model->$headerField != $rowField)
                {
                    $rowAdd = false;
                }

                $row[$headerField] = $rowField;
            }




            if($rowAdd)
            {
                // echo var_dump($row) . '<br>';

                array_push($rows, $row);
            }
            
            $rowAdd = true;
            $index++;
        }

        // die(var_dump($rows));
        
        return $rows;
    }



    
    public function fetchAll()
    {
        $tables = array();
        $tableName = '';

        $it = new \RecursiveDirectoryIterator($this->path);
        
        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv' && $file->getFileName() == $this->csv) {

                $tableName = $file->getPath() . '\\' . $file->getFileName();

                $tables[$tableName] = $this->CSVtoArray($file, true);
            } 
        }

        // die(var_dump($tables));

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