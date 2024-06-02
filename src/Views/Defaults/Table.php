<?php

namespace Views\Defaults;

use Views\View;
use Views\Includes\Includes;
use \utilities as u;

class Table extends View
{
    public string $name;
    public array $classLists = 
    [
        'Default' =>
        [
            'table'=>'w3-table-all w3-container w3-round-medium w3-card-4 w3-padding-16',
            'tableStyle'=>'display: inline-block; max-height: 80vh; overflow-y: overlay;',
            'name'=>'w3-container w3-black w3-round-medium',
            'nameStyle'=>'width:550px;',
            'headRow'=>'w3-black'
        ],

        'Other' =>
        [
            'table'=>'w3-table-all w3-container w3-round-medium w3-card-4 w3-padding-16',
            'tableStyle'=>'display: inline-block; max-height: 80vh; overflow-y: overlay;',
            'name'=>'w3-container w3-black w3-round-medium',
            'nameStyle'=>'width:550px;',
            'headRow'=>'w3-black'
        ]
    ];

    public function __construct(string $name, array $entities, string $type='Default', $method='')
    {
        $this->name = $name;
        $this->method = $method;

        $this->cssBundle = '';
        $this->jsBundle = '';

        $this->element = $this->createTable($entities, $type);
    }



    public function createTable($entities, $type)
    {
        $table = $this->build('table')
                        ->attr('class', $this->classLists[$type]['table'])
                        ->attr('style', $this->classLists[$type]['tableStyle']);

        $name = $this->build('div')
                        ->attr('class', $this->classLists[$type]['name'])
                        ->attr('style', $this->classLists[$type]['nameStyle'])
                        ->content('<h2>'.$this->name.'</h2>')
                        ->create();

        $head = $this->build('thead');

        $row = $this->build('tr')
                ->attr('class', $this->classLists[$type]['headRow']);

        $cells = $this->build('th')
                    ->content(implode('</th><th>', array_keys((array)current($entities))))
                    ->create();

        $row = $row->content($cells)->create();

        $head = $head->content($row)->create();

        $body = $this->build('tbody');

        $content = '';
        foreach($entities as $entity)
        {
            $row = $this->build('tr');

            $cells = $this->build('td')
                            ->content(implode('</td><td>', array_map([$this,'entities'], (array)$entity)))
                            ->create();

            $row = $row->content($cells)->create();

            $content .= $row;
        }


        $body = $body->content($head . $content)->create();

        $table = $table->content($body)->create();

        return $this->build('div')
                    ->content($name . $table);
    }


    function entities($field)
    {
      return !empty($field) ? htmlentities($field) : htmlentities("none");
    }
}