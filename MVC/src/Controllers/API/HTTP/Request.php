<?php

namespace Controllers\API\HTTP;

class Request
{
    public array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }
}