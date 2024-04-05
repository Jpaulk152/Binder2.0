<?php


spl_autoload_register('Autoloader::loadConfig');
// \spl_autoload_register('src\Autoloader::loadModels');
spl_autoload_register('Autoloader::loadViews');
// \spl_autoload_register('src\Autoloader::loadControllers');
// \spl_autoload_register('src\Autoloader::loadRoutes');
// \spl_autoload_register('src\Autoloader::loadHtmlBuilders');
// \spl_autoload_register('src\Autoloader::loadViewModels');


require_once('config.php');

class Autoloader
{
    
    public static $testing = false;

    static function load($path, $className){

        // die(config::app_root());

        // $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, config::app_root().$path);

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

    public static function loadConfig($className)
    {
        $filePath = '/';
        self::load($filePath, $className);
    }

    // public static function loadModels($className)
    // {
    //     $filePath = '/Models/';
    //     self::load($filePath, $className);
    // }

    public static function loadViews($className)
    {
        $filePath = '/Views/';
        self::load($filePath, $className);
    }

    // public static function loadControllers($className)
    // {        
    //     $filePath = '/Controllers/';
    //     self::load($filePath, $className);
    // }

    // public static function loadRoutes($className)
    // {
    //     $filePath = '/Routes/';
    //     self::load($filePath, $className);
    // }

    // public static function loadHtmlBuilders($className)
    // {    
    //     $filePath = '/ViewModels/Builders/';
    //     self::load($filePath, $className);
    // }

    // public static function loadViewModels($className){
    //     $filePath = '/ViewModels/';
    //     self::load($filePath, $className);
    // }
}
