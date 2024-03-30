
<?php

  // On get, use the number passed to retrieve a color value and return.
  if ($_SERVER["REQUEST_METHOD"] == "GET"){

    $theNumber = filter_input(INPUT_GET, 'num', FILTER_SANITIZE_URL);
    $success = true;

      switch ($theNumber){
        case 0:
            $color = "red";
            break;

        case 1:
            $color = "green";
            break;

        case 2:
            $color = "yellow";
            break;

        case 3:
            $color = "blue";
            break;

          case 4:
            $color = "purple";
            break;

        default:
          $success = false;
    }


    echo json_encode(array("success"=>$success, "newNumber"=>$theNumber, "color"=>$color));

  }







