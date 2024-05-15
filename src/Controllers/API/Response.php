<?php

namespace Controllers\API;

class Response
{
    private $content;
    private $status;
    private $headers;

    public function __construct($content='', $status=200, $headers=[])
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;

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