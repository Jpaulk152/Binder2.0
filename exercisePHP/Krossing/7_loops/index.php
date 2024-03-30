
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

        // for ($i = 0 ; $i <= 10; $i++) {
        //     echo "This is iteration number " . $i . "<br>";
        // }

        //     $test = 5;
        // while ($test < 10) 
        // {
        //     echo $test;
        //     $test++;
        // }

        // do {
        //     echo $test;
        //     $test++;
        // } while ($test < 10)

        // $fruit = array("apple", "banana", "orange");

        // foreach($fruit as $item)
        // {
        //     echo $item . "<br>";
        // }

        $fruit = array("Apple" => "Red", "Banana" => "Yellow", "Orange" => "Orange");

        foreach($fruit as $item => $color)
        {
            echo $item . "s are " . $color . "<br>";
        }

    ?>

</body>
</html>