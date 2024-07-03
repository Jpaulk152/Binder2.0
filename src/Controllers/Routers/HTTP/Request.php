<?php

namespace Controllers\Routers\HTTP;

class Request
{
    public array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }
}