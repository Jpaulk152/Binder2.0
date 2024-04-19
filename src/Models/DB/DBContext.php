<?php

namespace Models\DB;

use Models\DB\SQLConfig;

#[\AllowDynamicProperties]
class DBContext extends DB
{

    function __construct()
    {
        parent::__construct();

        $this->createSets();
    }


    function createSets()
    {
        $tableNameQuery = 'SHOW TABLES';
        $tableNames = $this->connection->query($tableNameQuery);
        
        while($tableName = $tableNames->fetch_array())
        {
            $tableName = $tableName[0];
            $fieldNameQuery = 'SELECT column_name FROM information_schema.columns WHERE table_schema = "'. SQLConfig::$databaseName .'" AND table_name = "' . $tableName . '"';
            $fieldNames = $this->connection->query($fieldNameQuery);
            
            $i=0;
            $fieldArray = array();

            // $field = $fieldNames->fetch_array();
            // die(var_dump($field[0]));

            while($field = $fieldNames->fetch_array())
            {
                $fieldArray[$i] = $field[0];
                $i++;
            }
            
            $this->$tableName = new DBSet($tableName, $fieldArray);
        }
    }



    function tableInfo()
    {
        $tableNameQuery = 'SHOW TABLES';
        $tableNames = $this->connection->query($tableNameQuery);

        echo '#########################################################################<br>';
        // die(var_dump($result));
        while($tableName = $tableNames->fetch_array()[0])
        {
            echo 'table name: ' . $tableName . '<br><br>';

            $fieldNameQuery = 'SELECT column_name FROM information_schema.columns WHERE table_schema = "'. SQLConfig::$databaseName .'" AND table_name = "' . $tableName . '"';
            $fieldNames = $this->connection->query($fieldNameQuery);
            
            while($field = $fieldNames->fetch_array()[0])
            {
                echo  $field . '<br>';
            }

            echo '<br><br>';
            echo '#########################################################################<br>';
        }
        die();
    }

   
}