


<?php
// die(var_dump($allFilesArray));
// array_walk_recursive($allFilesArray, function($item, $key)
// {
//     echo "$key => $item <br>";
// });



// die(var_dump($allFilesArray));
// foreach($allFilesArray as $file)
// {
//     echo 'File Name: ' . $file['fileName'] . '<br>';

//     for ($i=1; $i<count($file); $i++)
//     {
//         echo 'Item '.$i.': ' . $file[$i] . '<br>';
//     }

//     array_walk_recursive($file, function($item, $key)
// {
//     echo "$key => $item <br>";
// });

//     echo '<br><br>';
// }

// array_walk_recursive($array, function($item, $key)
// {
//     echo "$key => $item <br>";
// });



use Models\Menu;

$menu = new Menu();

$table = $menu->get('content1.csv');

$tableName = array_keys($table)[0];

$items = $table[$tableName];



$rows = array();
for($i=1;$i<count($items);$i++)
{
    $row = array();
    for($j=0;$j<count($items[$i]);$j++)
    {
        $row[$items[0][$j]] = $items[$i][$j];
    }
    $rows[$i-1] = $row;
}

$rows;

?>
<h1><?php echo $tableName ?></h1>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<?php if (count($rows) > 0): ?>
<table class="w3-table-all">
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys(current($rows))); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($rows as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

