<?php

namespace Controllers;

use \utilities as u;
use Controllers\API\HTTP\Response;
use DirectoryIterator;

class ResourceController extends Controller
{
    private string $path;
    private string $includes;
    private string $css;
    private string $js;
    private string $media;
    private string $materials;
    private string $test_media;

    public function __construct()
    {
        parent::__construct();

        $this->path = __DIR__ . u::switchSlash('/resources/');

    }

    public function stylesheet()
    {
        if (isset($_SESSION['stylesheet']))
        {
            new Response($_SESSION['stylesheet'], 200, 'text/css');
            return true;
        }
        else
        {
            return false;
        }
    }

    public function jscripts()
    {
        if (isset($_SESSION['jscripts']))
        {
            new Response($_SESSION['jscripts'], 200, 'text/javascript');
            return true;
        }
        else
        {
            return false;
        }
    }

    public function media(string $resource)
    {
        // new Response($resource, 200, 'text/html');
        // return true;
        u::writeLog('resource: ' . $resource, 'ResourceController.txt');


        $path = $this->path . u::switchSlash('media/' . $resource);

        $resource = file_get_contents($path);

        if ($resource)
        {
            new Response($resource, 200, 'text/html');
            return true;
        }
        else
        {
            return false;
        }
    }


    public function css()
    {
        $path = $this->path . u::switchSlash('includes/css/');

        $css = '';
        $css .= file_get_contents($path.'reset.css');
        $css .= file_get_contents($path.'app.css');
        $css .= file_get_contents($path.'w3.css');

        $temp = $this->scanResources($path.'temp');
        if($temp)
        {
            $css .= $temp;
        }

        if (!empty($css))
        {
            new Response($css, 200, 'text/css');
            return true;
        }

        return false;
    }

    public function js()
    {
        $path = $this->path . u::switchSlash('includes/js/');

        $js = '';
        $temp = $this->scanResources($path);
        if($temp)
        {
            $js .= $temp;
        }

        if (!empty($js))
        {
            new Response($js, 200, 'text/javascript');
            return true;
        }

        return false;
    }



    protected function scanResources(string $path)
    {   
        $contents = '';

        if($dir = scandir($path))
        {
            foreach($dir as $file)
            {
                $file = $path . DIRECTORY_SEPARATOR . $file;
                if (is_file($file))
                {
                    $contents .= file_get_contents($file);
                }
            }
        }

        if (!empty($contents))
        {
            return $contents;
        }

        return false;
    }

}