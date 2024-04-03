<?php

namespace Models\DB;

// require_once "dbConnector.php";
// require_once "dbInterface.php";

// require_once('../Autoloader.php');

class Select extends DBConnector implements DBInterface {

    public function from($table){

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

        return $this->mockExec($table);


    }

    public function addFilter(string $filter, string $field){

    }

    public function fetchAll(){
        
    }

    public function match(array $range){

    }

    public function unmatch(array $range){

    }

}