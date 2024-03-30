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


        $nl = "<br><br>";

        // String fucntions
        // $string = "Hello World!";

        // $string = explode(" ", $string);

        // echo $string[1];


        // Math functions
        // $number = -5.5;

        // echo abs($number);
        // echo round($number);
        // echo pow(2, 3);
        // echo sqrt(16);
        // echo rand(1, 100);


        // Array functions
        // $fruit = ["apple", "banana", "orange"];

        // echo count($fruit);

        // echo is_array($fruit);

        // echo array_push($fruit, "kiwi");
        // print_r($fruit);

        // array_pop($fruit);
        // print_r($fruit);

        // print_r(Array_reverse($fruit));

        // print_r(array_merge($fruit, array_reverse($fruit)));

        // Date functions
        echo date("Y-m-d H:i:s") . $nl;

        echo time() . $nl;

        $date = "2023-04-11 12:00:00";


        // 1970-01-01 00:00:00 until the date given
        echo strtotime($date);

    ?>

</body>
</html>