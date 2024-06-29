<?php

namespace Views\Elements;

use \utilities as u;

class Button2 extends Element
{
    public string $name;
    public string $function;
    public string $parameters;

    public function __construct(string $name, string $function, array ...$parameters)
    {
        $this->name = $name;
        $this->function = $function;

        if (!empty($parameters))
        {
            $this->parameters = $this->toJSON($parameters);
            $this->function .= "('".$this->parameters."')";
        }

        parent::__construct('button', $this->name);

        $this->addAttributes(
            [
                'class'=>'w3-button',
                'onclick'=>$this->function
            ]
        );
    }
}