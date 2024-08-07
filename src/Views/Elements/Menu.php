<?php

namespace Views\Elements;

use Views\View;
use \utilities as u;

class Menu extends View
{
    public function __construct($rows)
    {

        if (empty($rows))
        {
            parent::__construct('No content provided');
            return;
        }

        $buttons = [];


        foreach ($rows as $row)
        {
            if (is_array($row))
            {
                $buttons[] = new Expander(clone $row[0], new Menu($row['children']));
            }
            else
            {
                $button = clone $row;
                $buttons[] = $button->attr('class', 'w3-bar-item');
            }
        }


        // for($i=0;$i<count($rows);$i++)
        // {
        //     if (is_a($rows[$i], Element::class))
        //     {
        //         $buttons[$i] = clone $rows[$i];
        //         $buttons[$i]->addAttributes($mainAttributes, ['class'=>'w3-bar-item']);
        //     }
        //     else if (array_key_exists($subMenuName, $rows[$i]))
        //     {
        //         $buttons[$i] = new $subMenuButton(
        //             new $menuButton(...$rows[$i]), 
        //             new Menu(...$rows[$i][$subMenuName])
        //         );

        //         $buttons[$i]->elements[0]->setOnclick($subFunction);
        //         $buttons[$i]->addAttributes($subAttributes);
        //     }
        //     else
        //     {
        //         $buttons[$i] = new $menuButton(...$rows[$i]);
        //         $buttons[$i]->setOnclick($function);
        //         $buttons[$i]->addAttributes($mainAttributes, ['class'=>'w3-bar-item']);
        //     }

            
        // }

        parent::__construct(...$buttons);
    }




    // public function __construct(string $menuButton, string $function, array $mainAttributes, string $subMenuButton, string $subFunction, array $subAttributes, string $subMenuName, ...$rows)
    // {

    //     if (empty($rows))
    //     {
    //         parent::__construct('No content provided');
    //         return;
    //     }

    //     $buttons = [];
    //     for($i=0;$i<count($rows);$i++)
    //     {
    //         if (is_a($rows[$i], Element::class))
    //         {
    //             $buttons[$i] = clone $rows[$i];
    //             $buttons[$i]->addAttributes($mainAttributes, ['class'=>'w3-bar-item']);
    //         }
    //         else if (array_key_exists($subMenuName, $rows[$i]))
    //         {
    //             $buttons[$i] = new $subMenuButton(
    //                 new $menuButton(...$rows[$i]), 
    //                 new Menu($menuButton, $function, $mainAttributes, $subMenuButton, $subFunction, $subAttributes, $subMenuName, ...$rows[$i][$subMenuName])
    //             );

    //             $buttons[$i]->elements[0]->setOnclick($subFunction);
    //             $buttons[$i]->addAttributes($subAttributes);
    //         }
    //         else
    //         {
    //             $buttons[$i] = new $menuButton(...$rows[$i]);
    //             $buttons[$i]->setOnclick($function);
    //             $buttons[$i]->addAttributes($mainAttributes, ['class'=>'w3-bar-item']);
    //         }

            
    //     }

    //     parent::__construct(...$buttons);
    // }
}