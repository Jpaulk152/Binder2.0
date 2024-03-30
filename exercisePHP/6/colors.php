
<?php

  // On get, use the number passed to retrieve a color value and return.
  if ($_SERVER["REQUEST_METHOD"] == "GET"){

    $id = filter_input(INPUT_GET, 'color', FILTER_SANITIZE_URL);
    $success = true;

      switch ($id){
        case 0:
            $color = "w3-red";
            break;

        case 1:
            $color = "w3-green";
            break;

        case 2:
            $color = "w3-yellow";
            break;

        case 3:
            $color = "w3-blue";
            break;

          case 4:
            $color = "w3-purple";
            break;

        default:
          $success = false;
    }


    echo json_encode(array("success"=>$success, "color"=>$color));

  }







