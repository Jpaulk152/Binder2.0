<?php


class utilities {

    public static bool $testing = false;


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


    public static function autoLoad()
    {
        @spl_autoload_register('self::load');
    }
   
    static function load($className){

        $file = self::switchSlash(__DIR__.'/'.$className.'.php');
    
        if (self::$testing)
        {
            echo ' checked:    '.$file.'...<br>';
        }
        
        if(file_exists($file)){
    
            if (self::$testing)
            {
                echo 'it exists.. <br>';
            }
    
            require_once($file);
        }
    }


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
    


    public static function printPathInfo($all = false)
    {
        if ($all)
        {
            die(var_dump($_SERVER));
        }
        

        echo '<br><br> '.

            '__DIR__ <br>' . __DIR__

        .' <br>';

        echo '<br> '.

            'SCRIPT_NAME <br>' . $_SERVER['SCRIPT_NAME']

        .' <br>';

        echo '<br> '.

            'SCRIPT_FILENAME <br>' . $_SERVER['SCRIPT_FILENAME']

        .' <br>';

        echo '<br> '.

            'REQUEST_URI <br>' . $_SERVER['REQUEST_URI']

        .' <br>';

        echo '<br> '.

            'ORIG_PATH_INFO <br>' . $_SERVER['ORIG_PATH_INFO']

        .' <br>';

        echo '<br> '.

            'PATH_INFO <br>' . $_SERVER['PATH_INFO']

        .' <br>';

        echo '<br> '.

            'QUERY_STRING <br>' . $_SERVER['QUERY_STRING']

        .' <br>';


        strtok($_SERVER['SCRIPT_FILENAME'], DIRECTORY_SEPARATOR);
        $script = '';
        while($filepath = strtok(DIRECTORY_SEPARATOR))
        {
            $script = $filepath;
        }
        echo '<br> '.

        'EXECUTING SCRIPT <br>' . $script

    .   ' <br><br>';
    }


    public static function writeLog($msg, $file = 'log.txt')
    {
        $log = fopen($file, 'a');

        fwrite($log, $msg . "\n");

        fclose($log);
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

        utilities::writeLog($this->msg, 'errorLog.txt');

        echo $this->msg;
        exit(1);
    }

   
}