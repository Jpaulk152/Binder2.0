<?php

spl_autoload_register('Autoloader::loadNameSpaces');

require_once('config.php');

class Autoloader
{
    public static $testing = false;

    static function load($path, $className){

        $path = utilities::switchSlash((config::src_root().$path));

        $file = $path.$className.'.php';

        if (self::$testing)
        {
            echo $file.' checked... <br>';
        }
        
        if(file_exists($file)){

            if (self::$testing)
            {
                echo 'it exists.. <br>';
            }

            require($file);
        }
    }

    public static function loadNameSpaces($className)
    {
        $filePath = '';
        self::load($filePath, $className);
    }
}
