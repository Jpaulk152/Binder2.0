<?php

namespace Views\Defaults;

use stdClass;
use Views\View;
use Views\Includes\Includes;
use \utilities as u;

class Form extends View
{
    public string $name;
    public array $classLists = 
    [
        'Default' =>
        [
            'header'=>'w3-container primaryBackground w3-round-medium',
            'input'=>'w3-border-bottom w3-hover-grey',
            'inputStyle'=>'display: inline-block; max-height: 80vh; overflow-y: overlay; margin: 10px 10px 30px 10px;',
            'label'=>'primaryBackground w3-text-white w3-right-align w3-round-medium',
            'labelStyle'=>'display:inline-block; padding:5px;',
            'group'=>'w3-group',
            'groupStyle'=>'min-width:500px;',
            'submit'=>'w3-button w3-black w3-hover-blue w3-round-medium',
            'form'=>'w3-container w3-round-medium w3-card-4 w3-padding-16',
            'formStyle'=>'display: inline-block; max-height: 80vh; overflow-y: overlay; margin: 10px;'
            
        ],

        'Other' =>
        [
            'header'=>'w3-container w3-black w3-round-medium',
            'input'=>'w3-border-bottom w3-hover-grey',
            'inputStyle'=>'display: inline-block; max-height: 80vh; overflow-y: overlay; margin: 10px 10px 30px 10px;',
            'label'=>'w3-black w3-text-white w3-right-align w3-round-medium',
            'labelStyle'=>'display:inline-block; padding:5px;',
            'group'=>'w3-group',
            'groupStyle'=>'min-width:500px;',
            'submit'=>'w3-button w3-black w3-hover-blue w3-round-medium',
            'form'=>'w3-container w3-round-medium w3-card-4 w3-padding-16',
            'formStyle'=>'display: inline-block; max-height: 80vh; overflow-y: overlay; margin: 10px;'
        ]
    ];

    public function __construct(string $name, stdClass $entity, string $type='Default', $method='')
    {
        $this->name = $name;
        $this->method = $method;

        $this->cssBundle = '';
        $this->jsBundle = '';

        $this->element = $this->createForm($entity, $type);
    }


    public function createForm($entity, $type)
    {
        $header = $this->build('div')
                        ->attr('class', $this->classLists[$type]['header'])
                        ->content('<h2>'.$this->name.'</h2>')
                        ->create();

        $fields = '';
        foreach ($entity as $field => $value)
        {
        $input = $this->build('input')
                    ->attr('type', 'text')
                    ->attr('name', $field)
                    ->attr('value', !empty($value) ? $value : '')
                    ->attr('class', $this->classLists[$type]['input'])
                    ->attr('style', $this->classLists[$type]['inputStyle']);
                    
                    if(empty($this->method))
                    {
                        $input->disabled();
                    }

                    $input = $input->create();

        $label = $this->build('label')
                    ->attr('class', $this->classLists[$type]['label'])
                    ->attr('style', $this->classLists[$type]['labelStyle'])
                    ->content($field)
                    ->create();

        $group = $this->build('div')
                    ->attr('class', $this->classLists[$type]['group'])
                    ->attr('style', $this->classLists[$type]['groupStyle'])
                    ->content($input.$label)
                    ->create();

        $fields .= $group;
        }

        $submit = '';
        if (!empty($this->method))
        {
        $submit = $this->build('input')
                    ->attr('class', $this->classLists[$type]['submit'])
                    ->attr('onclick', 'javascript:'.$this->method.'(event)" value="'.$this->method.'"')
                    ->create();
        }


        $form = $this->build('form')
                ->attr('class', $this->classLists[$type]['form'])
                ->attr('style', $this->classLists[$type]['formStyle'])
                ->content($header.$fields.$submit);


        return $form;
    }
}