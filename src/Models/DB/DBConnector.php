<?php

    namespace Models\DB;


    // require_once "sqlConfig.php";
    // require_once('../Autoloader.php');

    class DBConnector {

        protected $conn;

        protected $fields;

        private $sqlQuery;


        // Fields should be required when not mocking
        function __construct(array $_fields = [])
        {
            $this->connect(SQLConfig::$serverName, SQLConfig::$databaseName, SQLConfig::$userName, SQLConfig::$password);

            $this->fields = $_fields;

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

            return $this;

        }

        function __destruct()
        {
            $this->conn = null;
        }

        protected function connect($serverName, $databaseName, $userName, $password){

            // try{
            //     $this->conn = new PDO('mysql:host='.$serverName.';dbname='.$databaseName.'"', $userName, $password);

            //     // set the PDO error mode to exception
            //     $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //     echo "Connected Successfully";
            // }
            // catch(PDOException $e){
            //     // echo "Connection Failed: " . $e->getMessage();

            //     echo "Hit dbConnector->connect catch block";
            // }

        }
    }


?>