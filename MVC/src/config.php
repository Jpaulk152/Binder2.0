<?php

class config{

  public static function baseURL(){
    return sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME']
      );
  }


  public static function doc_root(){
    return $_SERVER['DOCUMENT_ROOT'];
  }

  public static function app_root(){
    return self::doc_root() . '/src';
  }

  public static function public_root(){
    return self::doc_root() . '/public';
  }
}






// function __autoload($class) {
//     $class_name = strtolower($class);
//     $path       = "{$class}.php";
//     if (file_exists($path)) {
//         require_once($path);
//     } else {
//         die("The file {$class}.php could not be found!");
//     }
//  }

// spl_autoload_register('autoloader::load');
 
// class autoloader{

//    public static function load(){
//       require_once 'yourPath/'.'yourphpFile'.'.php';
//    }

// }