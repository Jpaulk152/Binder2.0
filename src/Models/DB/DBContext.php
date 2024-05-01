<?php

namespace Models\DB;

use Models\DB\SQLConfig;

#[\AllowDynamicProperties]
class DBContext
{
    protected $connection;
	protected $query;
    protected $show_errors = TRUE;
    protected $query_closed = TRUE;
	public $query_count = 0;

    function __construct()
    {		
        $this->createConnection();


        $this->createSets();
    }


    function createConnection($charset = 'utf8')
    {
        $this->connection = new \mysqli(SQLConfig::$serverName, SQLConfig::$userName, SQLConfig::$password, SQLConfig::$databaseName);

		if ($this->connection->connect_error) 
        {
			$this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}

		return $this->connection->set_charset($charset);
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

            // while($field = $fieldNames->fetch_array()[0])
            // {
            //     echo  $field . '<br>';
            // }

            echo '<br><br>';
            echo '#########################################################################<br>';
        }
        die();
    }



    

    public function query($query) {

        // die(var_dump($query));
        
        $this->createConnection();

        if (!$this->query_closed) {
            $this->query->close();
        }

		if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {

                $x = func_get_args();
                $args = array_slice($x, 1);
				$types = '';
                $args_ref = array();

                foreach ($args as $k => &$arg) {
					if (is_array($args[$k])) {
						foreach ($args[$k] as $j => &$a) {
							$types .= $this->_gettype($args[$k][$j]);
							$args_ref[] = &$a;
						}
					} else {
	                	$types .= $this->_gettype($args[$k]);
	                    $args_ref[] = &$arg;
					}
                }
				array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }

            $this->query->execute();
           	if ($this->query->errno) {
				$this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
           	}
            $this->query_closed = FALSE;
			$this->query_count++;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
        }
		return $this;
    }


	public function fetchAll($callback = null) {
	    $params = array();
        $row = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback != null && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ($value == 'break') break;
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
		return $result;
	}

	public function fetchArray() {
	    $params = array();
        $row = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
		while ($this->query->fetch()) {
			foreach ($row as $key => $val) {
				$result[$key] = $val;
			}
		}
        $this->query->close();
        $this->query_closed = TRUE;
		return $result;
	}

	public function close() {
		return $this->connection->close();
	}

    public function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

	public function affectedRows() {
		return $this->query->affected_rows;
	}

    public function lastInsertID() {
    	return $this->connection->insert_id;
    }

    public function error($error) {
        if ($this->show_errors) {
            exit($error);
        }
    }

	private function _gettype($var) {
	    if (is_string($var)) return 's';
	    if (is_float($var)) return 'd';
	    if (is_int($var)) return 'i';
	    return 'b';
	}

	public function colNames($table) { return $this->columnNames($table); }
	public function columnNames($table) {
		$array = $this->query("SHOW columns FROM $table")->fetchAll();
		foreach($array as $row) { $newArray[] = $row['Field']; }
		return $newArray;
	}

	public function table($table) {
		return $this->query("SHOW columns FROM $table")->fetchAll();
	}

	public function getPrimaryKey($table) {
		$array = $this->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'")->fetchArray();
        if(!$array)
        {
            return false;
        }
		return $array['Column_name'];
	}
}