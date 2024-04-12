<?php

namespace Models\DB;

class File {

    protected $path=null;

    protected $name=null;

    protected $match=null;

    protected $unMatch=null;


    public function __construct($name)
    {
        $this->name = $name;
        return $this;
    }


    public function from($path='..\src\Models\DB\mockTables\Test\\')
    {
        $this->path = $path;
        return $this;
    }


    public static function addFilter(string $filter, string $field){

    }

    public function fetchAll(){
        $tables = array();
        $tableName = '';

        // $menu = \utilities::getDataFromCSV($name, $this->testPath);
        $it = new \RecursiveDirectoryIterator($this->path);

        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv') {

                $tableName = $file->getPath() . '\\' . $file->getFileName();

                $tables[$tableName] = $this->CSVtoArray($file);
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


    public function match(array $range){

        $this->match = $range;

        return $this;
    }

    public function unmatch(array $range){

        $this->unMatch = $range;

        return $this;
    }


    public function exec(){
        $tables = array();
        $tableName = '';

        // $menu = \utilities::getDataFromCSV($name, $this->testPath);
        $it = new \RecursiveDirectoryIterator($this->path);

        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv' && $file->getFileName() == $this->name) {

                $tableName = $file->getPath() . '\\' . $file->getFileName();

                $tables[$tableName] = $this->CSVtoArray($file);
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
                // var_dump($indexRow);
                continue;
            }


            $row = array();
            for($i=0;$i<count($header);$i++)
            {
                $headerField = $this->validate($i, $header,$index);
                $rowField = $this->validate($i, $indexRow, $index);

                // if we are matching, check for match
                if (isset($this->match) && count($this->match)>0 )
                {
                    foreach($this->match as $key => $constraints)
                    {
                        if ($headerField == $key)
                        {
                            if(!in_array($rowField, $constraints) && !empty($constraints))
                            {
                                $rowAdd = false;
                            }
                        }
                    }
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


}