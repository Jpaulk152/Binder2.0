<?php

namespace Models;

use DB\Select;

class Menu
{
    protected static $testPath = '../src/Models/DB/mockTables';

    protected function get($name)
    {
        $menu = \utilities::getDataFromCSV($name, $this->testPath);

        return $menu;
    }

    public function getAll()
    {

        $allArray = array();

        $it = new \RecursiveDirectoryIterator(self::$testPath);

        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getExtension() == 'csv') {

                // echo $file->getPath() . '/' . $file->getFileName() . '<br>';
                // $file->openFile('r');

                $open = $file->openFile('r');
                $array = $open->fgetcsv();

                array_push($allArray, $array);
 
                // array_walk_recursive($array, function($item, $key)
                // {
                //     echo "$key => $item <br>";
                // });

                // echo '<br>';
            } 
        }

        
        return $allArray;
    }

    protected function set()
    {

    }

    protected function add()
    {

    }

    protected function remove()
    {

    }
}