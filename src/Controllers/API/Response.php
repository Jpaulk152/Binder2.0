<?php

namespace Controllers\API;

class Response
{

    public function __construct(private $content='', private int $status=200, private array $headers=[])
    {

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