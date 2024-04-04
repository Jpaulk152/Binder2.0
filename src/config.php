<?php

require_once('utilities.php');

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
    return utilities::switchSlash(self::doc_root() . '/MVC/src');
  }

  public static function public_root(){
    return utilities::switchSlash(self::doc_root() . '/MVC/public');
  }
}

