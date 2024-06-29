<?php

namespace Views\Elements;

use \utilities as u;

class Button extends Element
{
    public string $name;
    public string $id;
    public array $row;

    public function __construct(...$row)
    {
        $this->row = $row;
        $this->name = array_values($this->row)[0];
        $this->id = array_values($this->row)[1];

        parent::__construct('button', $this->name);

        $this->addAttributes(
            [
                'class'=>'w3-button',
            ],
        );
    }



    public function setOnclick(string $function)
    {
        $this->addAttributes(
            [
                'onclick'=> $function . '('.$this->toJSON(['id'=>$this->id]).');',
            ],
        );
    }
}