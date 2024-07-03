<?php

use Views\Includes\Includes;

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


    public static function dd($object, $continue = false, $from='')
    {

        echo '<script language="javascript" type="text/javascript" src="../public/js/buffer.js"></script>';
        echo '<script language="javascript" type="text/javascript" src="../public/js/debug.js"></script>';
        

        $type = gettype($object);
        if ($type == 'array')
        {
            $count = count($object);
        }
        else
        {
            $count = 1;
        }
        

        echo '<script>insertDebug(`' .$from. '`,`'. json_encode(print_r($object,true),true). '`,`'.$type.'`,`'.$count.'`)</script>';
        
        if (!$continue){die();}
        return;
    }
}

class ApplicationError
{
    public $errorType;
    public $msg;

    public function __construct($msg)
    {
        // echo '<body></body>';
        // u::dd(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10));

        $this->msg = $this->errorType . ': ' . $msg;
        $this->print();
    }
    
    public function print()
    {
        echo $this->msg;
        exit(1);
    }
}