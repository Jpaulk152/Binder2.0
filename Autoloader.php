<?php

spl_autoload_register('Autoloader::loadHtmlBuilders');
spl_autoload_register('Autoloader::loadControllers');
spl_autoload_register('Autoloader::loadViewModels');
spl_autoload_register('Autoloader::loadModels');
spl_autoload_register('Autoloader::loadConfig');

require_once('config.php');

class Autoloader
{

    public static $testing = false;

    static function load($path, $className){

        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, config::doc_root().$path);

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

    public static function loadHtmlBuilders($className){

        
        $path = '/ViewModel/Builder/';
        self::load($path, $className);
    }

    public static function loadControllers($className){

        
        $path = '/Controller/';
        self::load($path, $className);
    }

    public static function loadViewModels($className){
       
  
        $path = '/ViewModel/';
        self::load($path, $className);
    }

    public static function loadModels($className){


        $path = '/Model/';
        self::load($path, $className);
    }

    public static function loadConfig($className){

        $path = '/';
        self::load($path, $className);
    }


}
