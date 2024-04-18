<?php

class utilities {

    public static function switchSlash($path, $switch=true)
    {
        if ($switch)
        {
            return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        }
        else
        {
            return str_replace(array('/', '\\'), '/', $path);
        }
    }

    public static function consoleLog($message, $data=[])
    {
        // echo $message;

        array_unshift($data, $message);
        echo "<script>console.log('". json_encode($data) ."');</script>";
    }


    
    
}