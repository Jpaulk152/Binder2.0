<?php

namespace Views\Elements;

use Models\DB\DBSet;
use Views\View;
use \utilities as u;

class Table extends View
{
    public string $name;
    

    public function __construct(DBSet $dbSet, array $parameters=[], array $fields=[], array $orderBy=[])
    {
        $entities = $dbSet->set($parameters)->get($fields)->orderBy($orderBy)->toArray();
        $header = new Element('div', '<h2>'.$dbSet->table.'</h2>', ['class'=>'w3-container w3-black w3-round-medium', 'style'=>'width:550px;']);
        $head = new Element('thead');
        $row = new Element('tr', '', ['class'=>'w3-black']);
        $cells = new Element('th', implode('</th><th>', array_keys((array)current($entities))));

        $row->content($cells->create());
        $head->content($row->create());

        $body = new View($head);
        $body->setTagName('tbody');

        foreach($entities as $entity)
        {
            $row = new Element('tr');
            $cells = new Element('td', implode('</td><td>', array_map([$this,'entities'], (array)$entity)));
            $row->content($cells->create());
            $body->addElement($row);
        }

        parent::__construct($header, $body);
        $this->setTagName('table');
        $this->addAttributes(['class'=>'w3-table-all w3-container w3-round-medium w3-card-4 w3-padding-16', 'style'=>'display: inline-block;height:75vh;width:70%; overflow: auto;']);

        // $dbSet->purgeSet();
    }


    function entities($field)
    {

        if (!is_string($field))
        {
            return gettype($field);
        }

        return !empty($field) ? htmlentities($field) : htmlentities("none");
    }
}