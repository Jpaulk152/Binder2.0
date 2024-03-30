
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

        // $test = "Daniel";

        // function myfunction() {
        //     $localVar = "Hello, world!";

        //     return $GLOBALS["test"];
        // }

        // echo myFunction();

        function myFunction()
        {
            // Declare static variable
            static $staticVar = 0;

            // Incremenet the static variable
            $staticVar++;
            
            // Use the static variable
            return $staticVar;
        }

        echo myFunction();
        echo myFunction();
        echo myFunction();



        // didn't do anything with this
        // class myClass
        // {
        //     // Define a class variable
        //     public $classVar = "Hello, world!";

        //     // Define a class method
        //     public function myMethod()
        //     {
        //         // Use the clas variable
        //         echo $this->classVar; // Output: Hello, world!
        //     }
        // }

        
        // Defining a constant, always caps, always at top of script
        define("PI", 3.14);
        echo PI;

        define ("NAME", "Daniel");
        define("IS_ADMIN", true);

        function test()
        {
            echo PI;
        }

        test();

    ?>

</body>
</html>