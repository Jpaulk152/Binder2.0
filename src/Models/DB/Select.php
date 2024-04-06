<?php

namespace Models\DB;

// require_once "dbConnector.php";
// require_once "dbInterface.php";

// require_once('../Autoloader.php');

class Select extends DBConnector implements DBInterface {

    protected static $testPath = '..\src\Models\DB\mockTables\Test\\';

    protected $table='';

    protected $match=[];

    protected $unMatch=[];

    public function from($table)
    {
        // This switch is a placeholder for something like:
        /*
            [FROM __construct on the dbInterface class]
            $totalFields = count($this->fields); $i = 0;
            $this->sqlQuery = 'SELECT ';
            foreach ($this->fields as $f){
                if (++$i === $totalFields){
                    $this->sqlQuery .= $f . ' FROM';
                }
                else{
                    $this->sqlQuery .= $f . ', ';
                }
            }

            $this->sqlQuery .= $table;
        */

        // return $this->mockExec($table);


        $this->table = $table;

        return $this;
    }


    public function addFilter(string $filter, string $field){

    }

    public function fetchAll(){
        $tables = array();
        $tableName = '';
        $rows = null;

        // $menu = \utilities::getDataFromCSV($name, $this->testPath);
        $it = new \RecursiveDirectoryIterator(self::$testPath);

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
        $rows = null;

        // $menu = \utilities::getDataFromCSV($name, $this->testPath);
        $it = new \RecursiveDirectoryIterator(self::$testPath);

        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv' && $file->getFileName() == $this->table) {

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






    function validate($key,$array, $index)
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

        $index = 1;
        $open = $file->openFile('r');
        $header = $open->fgetcsv();
        
        while($indexRow = $open->fgetcsv())
        {
            $row = array();
            for($i=0;$i<count($header);$i++)
            {

                $headerField = $this->validate($i, $header,$index);
                $rowField = $this->validate($i, $indexRow, $index);

                // if we are matching, check for match
                if (count($this->match)>0 && !in_array($headerField, $this->match))
                {
                    continue;
                }

                $row[$headerField] = $rowField;
            }
            array_push($rows, $row);

            $index++;
        }


        return $rows;
    }


}