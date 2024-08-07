<?php

namespace Views\Includes;

use \utilities as u;
use \config;

class Includes
{

    public static $includePath = 'resources/';
    public static $resourcePath = 'resources/media/';

    public static function app()
    {
        // ob_start();
        // // require_once(self::$includePath .'css/reset.css');
        // // require_once(self::$includePath .'css/w3css-4-w3.css');
        // require_once('public/css/main.css');
        // // require_once('public/css/gauges.css');
        // require_once('public/css/card.css');
        // $css = ob_get_clean();

        // ob_start();
        // require_once('public/js/main.js');
        // require_once('public/js/layout.js');
        // require_once('public/js/mainContent.js');
        // require_once('public/js/test.js');
        // require_once('public/js/debug.js');
        // require_once('public/js/api.js');
        // require_once('public/js/hc.js');
        // $js = ob_get_clean();

        
        // config::includes([
        //     'stylesheet'=>$css,
        //     'jscripts'=>$js
        // ]);

        $includes = '
            <link rel="stylesheet" href="'. self::$includePath .'css/reset.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="'. self::$includePath .'css/w3.css"> <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
            <link rel="stylesheet" href="'. self::$includePath .'css/app.css">
            <link rel="stylesheet" href="resources/temp.css">
            <link rel="stylesheet" href="resources/app.css">

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script src="'. self::$includePath .'js/app.js"></script>
            <script src="'. self::$includePath .'js/hc.js"></script>
            <script src="'. self::$includePath .'js/debug.js"></script>
            <script src="'. self::$includePath .'js/api.js"></script>
            <script src="resources/temp.js"></script>
            <script src="resources/app.js"></script>
        ';

        return $includes;
    }

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
            <link rel="stylesheet" href="includes/app.css">
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
            <script src="includes/app.js"></script>
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