
<?php

  // On post, use the number passed to retrieve a color value and return.
  if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $theNumber = $_POST["num"];
    $success = true;

      switch ($theNumber){
        case 0:
            $color = "red";
            break;

        case 1:
            $color = "green";
            break;

        case 2:
            $color = "blue";
            break;

        case 3:
            $color = "yellow";
            break;

        default:
          $success = false;
    }

    $theNumber = increment($theNumber);

    echo json_encode(array("success"=>$success, "newNumber"=>$theNumber, "color"=>$color));

  }

  // Increments the number given by 1, up until 3.
  function increment($i)
  {
    $i++;
    // $i%=4; should be using this line. Errors out when the value reaches 4.
    $i%=5;
    return $i;
  }





