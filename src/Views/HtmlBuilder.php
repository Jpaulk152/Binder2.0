<?php

namespace Views;

use Views\ViewError;
use \utilities as u;

class HtmlBuilder {

    public $element;
    
    public function build(string $elementName){

        if($elementName == 'br' ||  $elementName == 'img')
        {
            $tagType = 'empty';
        }
        else
        {
            $tagType = 'container';
        }
        
        return new Element($tagType, $elementName);
    }


    public function createMenu($menuItems, $classList,  &$tabIndex=1) 
    {

        if (is_array($menuItems) && count($menuItems) > 0)
        {
            $menu = '';
            $tabIndex;
            
            foreach ($menuItems as $item)
            {
                $item = $this->menuData($item);

                // If the item is a menu build a submenu
                if ($this->isMenu($item)) 
                {
                    $i = $tabIndex;
                    $tabIndex++;

                    $subMenu =                  $this->createMenu($item['child'], $classList, $tabIndex);

                    $caret =                    $this->build('i')
                                                    ->attr('id', 'menu-'. $i .'-caret')
                                                    ->attr('class', $classList['caret'])
                                                    ->create();

                    $subMenuButton =            $this->build('button')
                                                    ->attr('id', 'menu-'. $i)
                                                    ->attr('class', $classList['subMenuButton'])
                                                    ->attr('onclick', "expand(this);location.href='" .$item['link']. "'")
                                                    ->content($caret . '   ' . $item['name'])
                                                    ->create();

                    $subMenu =                  $this->build('div')
                                                    ->attr('class', $classList['subMenu'])
                                                    ->content($subMenu)
                                                    ->create();

                    $subMenuContainer =         $this->build('div')
                                                    ->attr('class', $classList['subMenuContainer'])
                                                    ->attr('tabindex', $i)
                                                    ->content($subMenuButton . $subMenu)
                                                    ->create();


                    $menu .= $subMenuContainer;
                    
                }
                // else, if the item is a button build a button, this also means we are at the top level
                else if ($this->isButton($item))
                { 

                    $menuButton =               $this->build('a')
                                                    ->attr('class', $classList['menuButton'])
                                                    ->attr('href', $item['link'])
                                                    ->attr('tabindex', $tabIndex++)
                                                    ->content($item['name'])
                                                    ->create();

                    $menu .= $menuButton;
                    
                }
                // otherwise the item retrieved doesn't fit, so log it and build a placeholder that says 'resource not found'
                else
                {

                    $menuButton =               $this->build('a')
                                                    ->attr('class', $classList['menuButton'])
                                                    ->attr('href', '#')
                                                    ->attr('tabindex', $tabIndex++)
                                                    ->content('This resource was not found')
                                                    ->create();

                        $menu .= $menuButton;
                }
            }

            return $menu;

        }
        else
        {
            return false;
        }
    }



    function isMenu($item)
    {
        if(is_array($item) && array_key_exists('name', $item) && array_key_exists('link', $item) && array_key_exists('child', $item) && is_array($item['child']) && count($item['child']) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    function isButton($item)
    {
        if(is_array($item) && array_key_exists('name', $item) && array_key_exists('link', $item))
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    function menuData($item)
    {
        // die(var_dump($item));

        if(!$item)
        {
            throw new \Exception('Error in menuData function: no $item passed');
        }

        $itemArray = array_values((array)$item);

        $menuItem['name'] = $itemArray[0];
        $menuItem['link'] = $itemArray[1];


        if(isset($item->children))
        {
            $menuItem['child'] = $item->children;
        }
        

        return $menuItem;

    }
    
}


class Element
{
    public string $name;
    public array $attributes;
    public string $content;
    
    public string $tagType;

    public function __construct(string $tagType, string $name)
    {
        $this->name = $name;
        $this->attributes = [];
        $this->content = '';

        $this->tagType = $tagType;

        return $this;
    }

    public function content($content)
    {
        if ($this->tagType == 'empty')
        {
            new ViewError('Elements with Empty (non-container) Tags may not be passed content.');
        }

        $this->content = $content;

        return $this;
    }

    public function attr($attribute, $value)
    {
        array_push($this->attributes, $attribute.'="'.$value.'"');

        return $this;
    }

    public function create()
    {

        switch($this->tagType)
        {
            case 'container':
                $element = '<' . $this->name . ' ' . implode(' ', $this->attributes) . '>' . $this->content . '</' . $this->name . '>';
                break;
            case 'empty':
                $element = '<' . $this->name . ' ' . implode(' ', $this->attributes) . '/>';
                break;
            default:
                new ViewError('Element created without proper tagType.');
                break;
        }

        return $element;
    }
}

