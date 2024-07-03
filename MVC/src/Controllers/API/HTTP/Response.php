<?php

namespace Controllers\API\HTTP;

class Response
{
    private $content;
    private $contentType;

    public function __construct($content='', $status=200, $contentType='application/json', $headers=[])
    {
        $this->content = $content;
        $this->contentType = $contentType;

        header('Content-Type: ' . $this->contentType, false, $status);

        foreach($headers as $header)
        {
            header($header, false, $status);
        }

        $this->send();
    }

    public function send()
    {
        if ($this->contentType == 'application/json')
        {
            echo json_encode($this->content);
        }
        else
        {
            echo $this->content;
        }
    }
}