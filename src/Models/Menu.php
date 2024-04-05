<?php

namespace Models;

use DB\Select;

class Menu
{
    protected static $testPath = '..\src\Models\DB\mockTables';

    public function get($name)
    {
        // $menu = \utilities::getDataFromCSV($name, $this->testPath);



        $it = new \RecursiveDirectoryIterator(self::$testPath);

        // Loop through files
        foreach(new \RecursiveIteratorIterator($it) as $table) {
            if ($table->getExtension() == 'csv' && $table->getFileName() == $name) {

                $tableName = $table->getPath() . '\\' . $table->getFileName();
                $rows = array();

                $open = $table->openFile('r');

                while($row = $open->fgetcsv())
                {
                    array_push($rows, $row);
                }

                return array($tableName => $rows);
            } 
        }



        // return $menu;
    }

    public function getAll()
    {

        // $allMenuTables = array();

        // // array(
        // //     array(
        // //         'fileName' => 'derp',
        // //         array()
        // //     ),
        // //     array(
        // //         'fileName' => 'derp',
        // //         array()
        // //     ),
        // //     etc...
        // // )

        // $it = new \RecursiveDirectoryIterator(self::$testPath);

        // // Loop through files
        // foreach(new \RecursiveIteratorIterator($it) as $menu) {
        //     if ($menu->getExtension() == 'csv') {

        //         $menuName = $menu->getPath() . '\\' . $menu->getFileName();
        //         // $fileArray = array('fileName' => $fileName);
        //         // echo $fileName . '<br>';

        //         $open = $menu->openFile('r');

                
        //         while($row = $open->fgetcsv())
        //         {
                    


        //             array_push($fileArray, $row);
        //             array_push($allMenuTables, $fileArray);
        //         }

        //     } 
        // }

        // // die(var_dump($allArray));
        // return $allFilesArray;
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