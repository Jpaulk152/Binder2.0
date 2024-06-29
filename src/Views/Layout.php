<?php

namespace Views;

use \utilities as u;
use \config;

use Views\Elements\Element;

// A collection of Views to be displayed together.
class Layout extends View {

    public array $views = [];
    // public int $columns;

    public function __construct(...$rows)
    {
        // $this->columns = $columns;

        parent::__construct();

        // u::dd($rows);

        $this->addRows(...$rows);
        $this->addAttributes(['class'=>'layout']);

        $css = '
        
            .layout .w3-col, .layout .w3-rest {
                padding: 1em;
            }

            .layout .w3-cell {
                padding: 0 16px;
                vertical-align:top;
            }

            .layout .w3-cell-row {
                padding: 1em 0;
            }

            .layout {
                padding: 2em;
            }

        ';


        $js = "


            // $(document).ready(function(){
            
            //     layoutUnits = 'em';

            //     layouts = $('.layout').get();
            //     // console.log(layouts);

            //     for(i=0;i<layouts.length;i++)
            //     {
            //         colCount = layouts[i].getAttribute('columns');

            //         rows = layouts[i].getElementsByClassName('w3-row');

            //         for(j=0;j<rows.length;j++)
            //         {
            //             colWidth = getColumnWidth(rows[j], colCount, layoutUnits);
            //             columns = rows[j].getElementsByClassName('w3-col');
            //             rest = rows[j].getElementsByClassName('w3-rest');

            //             for(k=0;k<columns.length;k++)
            //             {
            //                 columns[k].style.width = colWidth;
            //                 columns[k].style.minWidth = colWidth;
            //             }

            //             for(k=0;k<rest.length;k++)
            //             {
            //                 rest[k].style.minWidth = colWidth;
            //             }
            //         }
            //     }
            // });
        ";

        config::includes(['jscripts'=>$js, 'stylesheet'=>$css]);
    }

    public function addRow(View $row) : void
    {
        $this->addElement($row);
    }



    public function addRows(...$rows) : void
    {
        foreach ($rows as $row)
        {
            if (is_array($row))
            {
                $newRow = new View();


                for($i=0;$i<count($row);$i++)
                {
                    $column = new View(clone $row[$i]);
                    $column->attr('class', 'w3-cell w3-mobile');
                    $newRow->addElement($column);
                }
            }
            else
            {
                $newRow = new View(clone $row);
            }

            $this->addRow($newRow->attr('class', 'w3-cell-row'));
        }
    }




    // public function addRows(...$rows) : void
    // {
    //     foreach ($rows as $row)
    //     {
    //         $newRow = new View();
            
    //         if (is_array($row))
    //         {
    //             $newRow->attr('class', 'w3-row');
    //             for($i=0;$i<$this->columns;$i++)
    //             {
    //                 $column = $row[$i];
    //                 $newColumn = new View($column);
    //                 $newColumn = $newRow->addElement($newColumn);
    //                 if (!isset($row[$i+1]) && $i+1 != $this->columns)
    //                 {
    //                     $newColumn->attr('class', 'w3-rest');
    //                     break;
    //                 }
    //                 else
    //                 {
    //                     $newColumn->attr('class', 'w3-col');
    //                 }
    //             }
    //         }
    //         else
    //         {
    //             $newRow->addElement($row);
    //         }

    //         $this->addRow($newRow);
    //     }
    // }
}

