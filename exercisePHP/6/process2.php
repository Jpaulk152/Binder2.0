
<?php

  // On get
  if ($_SERVER["REQUEST_METHOD"] == "GET"){

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
    $success = true;

      switch ($id){
        case 0:
            $image = "resources/pic1.jpg";
            $content = "<p>This is a p tag</p>";
            break;

        case 1:
            $image = "resources/pic2.jpg";
            $content = "<h5>This is an h5 tag</h5>";
            break;

        case 2:
            $image = "resources/pic3.jpg";
            $content = "<div>This is a div</div>";
            break;

        case 3:
            $image = "resources/pic4.jpg";
            $content = "<ul>This is a UL <li>thing 1</li> <li>thing 2</li></ul>";
            break;

    break;

        default:
          $success = false;
    }


    echo json_encode(array("success"=>$success, "image"=>$image, "content"=>$content));

  }







