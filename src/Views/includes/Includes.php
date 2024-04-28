<?php

namespace Views\Includes;

use \config;

class Includes
{

    public static $includePath = '../';
    public static $resourcePath = '../resources';

    public static function css()
    {

        $css = '
            <link rel="stylesheet" href="'. self::$includePath .'css/reset.css">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="'. self::$includePath .'css/main.css">
        ';

        echo $css;
    }


    public static function js()
    {
        $js = '
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script src="'. self::$includePath .'js/buffer.js"></script>
            <script src="'. self::$includePath .'js/taskHandler.js"></script>
            <script src="'. self::$includePath .'js/layout.js"></script>
            <script src="'. self::$includePath .'js/sideBar.js"></script>
            <script src="'. self::$includePath .'js/mainContent.js"></script>
            <script src="'. self::$includePath .'js/home.js"></script>
            <script src="'. self::$includePath .'js/lesson.js"></script>
            <script src="'. self::$includePath .'js/test.js"></script>
        ';

        echo $js;
    }

}