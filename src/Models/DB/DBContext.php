<?php

namespace Models\DB;



class DBContext
{
    private $connection;

    function __construct()
    {
        $this->connection = new \mysqli(SQLConfig::$serverName, SQLConfig::$userName, SQLConfig::$password, SQLConfig::$databaseName);

        if ($this->connection->connect_errno)
        {
            echo "Failed to connect to MySQL: " . $this->connection->connect_error;
            exit();
        }

        $this->tableInfo();

    }


    function __destruct()
    {
        $this->connection->close();
    }




    function tableInfo()
    {
        $tableNameQuery = 'SHOW TABLES';
        $tableNames = $this->connection->query($tableNameQuery);

        echo '#########################################################################<br>';
        // die(var_dump($result));
        while($table = $tableNames->fetch_array())
        {
            echo 'table name: ' . $table[0] . '<br><br>';

            $fieldNameQuery = 'SELECT column_name FROM information_schema.columns WHERE table_name = "' . $table[0] . '"';
            $fieldNames = $this->connection->query($fieldNameQuery);

            

            while($fields = $fieldNames->fetch_array())
            {
                // die(var_dump($fields));

                echo  $fields[0] . '<br>';
            }

            echo '<br><br>';
            echo '#########################################################################<br>';
        }
        die();
    }
}