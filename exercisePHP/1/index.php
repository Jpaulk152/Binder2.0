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

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <button>Click me!</button>
    </form>

    <?php
        
        session_start();
        if (empty($_SESSION["number"])) {
            $_SESSION["number"] = 1;
        }
        
        $i = $_SESSION["number"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            switch ($i){
                case 1:
                    $value = "First time!";
                    break;

                case 2:
                    $value = "Second time!";
                    break;

                case 3:
                    $value = "Third time!";
                    break;

                default:
                    echo "<p class='error-msg'>Something went wrong</p>";
                    exit(1);
            }
            
            echo "<p class='current-msg'>" . $value . "</p>";
            $i += 1;
            $i %= 4;
            $_SESSION["number"] = $i;

        }
    
    ?>
    
</body>
</html>