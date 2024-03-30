<?php

// var_dump($_SERVER["REQUEST_METHOD"]);

// if(isset($_POST["submit"])){

// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // htmlspeci... sanitizes user input
    $firstname = htmlspecialchars($_POST["firstname"]);

    $lastname = htmlspecialchars($_POST["lastname"]);

    $pets = htmlspecialchars($_POST["favoritepet"]);

    // htmlentities()

    echo "These are the data, that the user submitted";
    echo "<br>";
    echo "<br>";
    echo $firstname;
    echo "<br>";
    echo $lastname;
    echo "<br>";
    echo $pets;

    header("Location: ../index.php");
}
else{
    header("Location: ../index.php");
}