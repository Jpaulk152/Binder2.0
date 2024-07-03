<?php

namespace Models\CSV;


#[\AllowDynamicProperties]
class CSVContext
{

    protected $path='..\src\Models\Tables\Primary\\';

    public function __construct()
    {
        $this->createSets();
    }

    function createSets()
    {

        $it = new \RecursiveDirectoryIterator($this->path);
        $csvName = '';
        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv') {

                $csvName = substr($file->getFileName(), 0, strlen($file->getFileName())-4);

                $open = $file->openFile('r');
                $fields = $open->fgetcsv();

                $i=0;
                $fieldArray = array();

                foreach($fields as $field)
                {
                    $fieldArray[$i] = $field;
                    $i++;
                }

                $this->$csvName = new CSVSet($csvName, $fieldArray);
            } 
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



    function tableInfo()
    {
        $csvName = '';

        $it = new \RecursiveDirectoryIterator($this->path);
        
        echo '#########################################################################<br>';
        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv') {

                $csvName = substr($file->getFileName(), 0, count($file->getFileName())-5);

                $open = $file->openFile('r');
                $fields = $open->fgetcsv();

                // die(var_dump($fields));

                echo 'CSV name: ' . $csvName . '<br><br>';

                foreach($fields as $field)
                {
                        echo  $field . '<br>';
                }
                
                echo '<br><br>';
                echo '#########################################################################<br>';
            } 
        }

        die();
    }
}