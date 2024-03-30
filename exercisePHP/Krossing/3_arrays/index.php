<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    
<?php

    // $fruit = ["Apple", "Banana", "Cherry"];

    // echo $fruit[0];

    // $fruit[] = "Orange";

    // echo "<br><br>" . $fruit[3];

    // // unset($fruit[1]);

    // array_splice($fruit, 0, 1);

    // echo "<br><br>" . $fruit[1];
    // echo "<br><br>" . $fruit[2];

    // $test = ["Mango", "Pineapple"];

    // array_splice($fruit, 2, 0, $test);

    // echo "<br><br>" . print_r($fruit);
    

/*
    $tasks = [
        "laundry" => "Daniel", 
        "trash" => "Frida", 
        "vacuum" => "Basse", 
        "dishes" => "Bella"];

    echo $tasks["laundry"];

    print_r($tasks);

    echo count($tasks);

    sort($tasks);

    print_r($tasks);

    $tasks["dusting"] = "Tara";

    print_r($tasks);
*/



$food = [
    "fruit" => ["apple", "mango"],
    "meat" => ["chicken", "beef", "pork"],
    "vegetables" => ["cucumber", "carrot"]
];

echo $food["vegetables"][0];

?>

</body>
</html>