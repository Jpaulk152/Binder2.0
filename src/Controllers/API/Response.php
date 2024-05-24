<?php

namespace Controllers\API;

class Response
{
    private $content;

    public function __construct($content='', $status=200, $headers=['Content-Type: text/html'])
    {
        $this->content = $content;

        foreach($headers as $header)
        {
            header($header, true, $status);
        }

        $this->send();
    }

    public function send()
    {
        echo json_encode($this->content);
    }
}