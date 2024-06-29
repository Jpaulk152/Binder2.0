<?php

namespace Views\Elements;

use Views\View;

class Menu extends View
{
    public function __construct(string $menuButton, string $function, array $mainAttributes, string $subMenuButton, string $subFunction, array $subAttributes, string $subMenuName, ...$rows)
    {

        if (empty($rows))
        {
            parent::__construct('No content provided');
            return;
        }


        $buttons = [];
        for($i=0;$i<count($rows);$i++)
        {
            if (is_a($rows[$i], Element::class))
            {
                $buttons[$i] = clone $rows[$i];
                $buttons[$i]->addAttributes($mainAttributes);
            }
            else if (array_key_exists($subMenuName, $rows[$i]))
            {
                $buttons[$i] = new $subMenuButton(
                    new $menuButton(...$rows[$i]), 
                    new Menu($menuButton, $function, $mainAttributes, $subMenuButton, $subFunction, $subAttributes, $subMenuName, ...$rows[$i][$subMenuName])
                );

                $buttons[$i]->elements[0]->setOnclick($subFunction);
                $buttons[$i]->addAttributes($subAttributes);
            }
            else
            {
                $buttons[$i] = new $menuButton(...$rows[$i]);
                $buttons[$i]->setOnclick($function);
                $buttons[$i]->addAttributes($mainAttributes);
            }

            
        }

        parent::__construct(...$buttons);
    }
}