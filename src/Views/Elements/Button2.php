<?php

namespace Views\Elements;

use \utilities as u;

class Button2 extends Element
{
    public string $name;

    public function __construct(string $name, string ...$functions)
    {
        $this->name = $name;

        // if (!empty($parameters))
        // {
        //     foreach($parameters as &$parameter)
        //     {
        //         if (is_array($parameter))
        //         {
        //             $parameter = $this->toJSON($parameter);
        //         }
        //     }

        //     $this->parameters = "(". implode(', ', $parameters) .")";


        //     // u::dd($this->parameters);

        //     $this->function .= $this->parameters;
        // }

        parent::__construct('button', $this->name);

        $this->addAttributes(
            [
                'class'=>'w3-button',
                'onclick'=>implode('; ', $functions)
            ]
        );
    }
}