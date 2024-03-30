<?php

class config{

  public static function baseURL(){
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
      );
  }

  public static function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
    if (isset($_SERVER['HTTP_HOST'])) {
        $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
        $hostname = $_SERVER['HTTP_HOST'];
        $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        
        $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), -1, PREG_SPLIT_NO_EMPTY);
        $core = $core[0];
        
        $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
        $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
        $base_url = sprintf( $tmplt, $http, $hostname, $end );
    }
    else $base_url = 'http://localhost/';
    
    if ($parse) {
        $base_url = parse_url($base_url);
        if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
    }
    
    return $base_url;
  } 

  public static function doc_root(){
    return $_SERVER['DOCUMENT_ROOT'];
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