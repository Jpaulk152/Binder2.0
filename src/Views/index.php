<h1>This is the index page!</h1>


<?php

use Models\Menu;

$menu = new Menu();

$array = $menu->getAll();


array_walk_recursive($array, function($item, $key)
{
    echo "$key => $item <br>";
});

?>