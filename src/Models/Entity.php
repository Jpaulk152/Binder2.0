<?php

namespace Models;

#[\AllowDynamicProperties]
class Entity 
{
    protected string $id;
    protected string $name;
    protected string $table;
    protected string $primaryKey;

    public function __construct(array $properties)
    {
        $this->setAll($properties);
    }

    public function setAll(array $properties)
    {
        foreach($properties as $property=>$value)
        {
            $this->set($property, $value);
        }
    }

    public function set($property, $value)
    {
        $this->$property = $value;
    }

    public function get($property)
    {
        if (property_exists($this, $property) && isset($this->$property))
        {
            return $this->$property;
        }
        else
        {
            return false;
        }
    }
}