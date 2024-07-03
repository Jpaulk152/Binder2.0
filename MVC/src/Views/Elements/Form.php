<?php

namespace Views\Elements;

use Views\View;

class Form extends View
{
    public string $name;
    public array $fields;

    public function __construct(string $name, array $fields, Button $submit=null)
    {
        $this->name = $name;
        $this->fields = $fields;

        parent::__construct();
        $this->setTagName('Form');

        $header = new Element('div', $name, ['class'=>'w3-container w3-black w3-round-medium w3-margin-bottom w3-padding']);
        $this->addElement($header);

        foreach($fields as $field=>$value)
        {
            $input = new Element('input', '', ['type'=>'text', 'name'=>$field, 'value'=>!empty($value) ? $value : '', 'class'=>'w3-border-bottom w3-hover-grey', 'style'=>'display: inline-block; max-height: 80vh; overflow-y: overlay; margin: 10px 10px 30px 10px;']);
            if (is_null($submit)) {$input->disabled();}

            $label = new Element('label', $field, ['class'=>'w3-black w3-text-white w3-right-align w3-round-medium', 'style'=>'display:inline-block; padding:5px;']);
            $group = new View($input, $label);
            $group->addAttributes(['class'=>'w3-group', 'style'=>'min-width:500px;']);

            $this->addElement($group);
        }

        if (!is_null($submit))
        {
            $submit->addAttributes(['class'=>'w3-black w3-hover-blue w3-round-medium', 'style'=>'width: 50%;']);
            $this->addElement($submit);
        }

        $this->addAttributes(['class'=>'w3-container w3-round-medium w3-card-4 w3-padding-16', 'style'=>'display: inline-block; max-height: 80vh; overflow-y: overlay;']);
    }
}