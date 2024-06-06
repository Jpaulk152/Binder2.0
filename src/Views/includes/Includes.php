<?php

namespace Views\Includes;

class Includes
{

    public static $includePath = '../public/';
    public static $resourcePath = '../public/resources/';

    public static function css()
    {

        $css = '
            <link rel="stylesheet" href="'. self::$includePath .'css/reset.css">
            <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="'. self::$includePath .'css/w3css-4-w3.css">
            <link rel="stylesheet" href="'. self::$includePath .'css/main.css">
            <link rel="stylesheet" href="'. self::$includePath .'css/gauges.css">
            <link rel="stylesheet" href="'. self::$includePath .'css/card.css">
        ';

        return $css;
    }

    // <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    // <script src="'. self::$includePath .'js/buffer.js"></script>
    // <script src="'. self::$includePath .'js/taskHandler.js"></script>
    // <script src="'. self::$includePath .'js/sideBar.js"></script>

    public static function js()
    {
        $js = '
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script src="'. self::$includePath .'js/main.js"></script>
            <script src="'. self::$includePath .'js/layout.js"></script>
            <script src="'. self::$includePath .'js/mainContent.js"></script>
            <script src="'. self::$includePath .'js/test.js"></script>
            <script src="'. self::$includePath .'js/debug.js"></script>
            <script src="'. self::$includePath .'js/api.js"></script>
            <script src="'. self::$includePath .'js/hc.js"></script>
        ';

        return $js;
    }


    public static function path($resource)
    {
        switch($resource)
        {
            case 'logo':
                return self::$resourcePath . 'logo.png';
        }
    }

}