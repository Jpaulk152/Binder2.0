<?php

require_once('utilities.php');


class config{

  // public static $currentPath = '/MVC';
  public static $currentPath = '';

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

  public static function site_root(){
    return utilities::switchSlash(self::doc_root() . self::$currentPath, false);
  }

  public static function src_root(){
    return utilities::switchSlash(self::doc_root() . self::$currentPath .'/src/', false);
  }

  // public static function public_root(){
  //   return utilities::switchSlash(self::doc_root() . self::$currentPath . '/public/', false);
  // }

  // public static function include_path(){
  //   return utilities::switchSlash(self::$currentPath . '/../public/resources/', false);
  // }

  public static function app_root(){
    return utilities::switchSlash(self::$currentPath . '/index.php/', false);
  }
}

