<?php

include $_SERVER['DOCUMENT_ROOT']."/exercisePHP/7/View/htmlBuilder.php";


// function getSideBar(){

//     $sbBuilder = new sbBuilder();

//     $success = true;

//     $data = $sbBuilder->createSideBar($sbBuilder->sideBarArray);

//     return json_encode(array("success"=>$success, "data"=>$data));
// }
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    header('Content-Type: application/json');

    $function = filter_input(INPUT_GET, 'functionname', FILTER_SANITIZE_URL);
    $aResult = array();


    if( !isset($function) ) { $aResult['error'] = 'No function name!'; }

    // if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
    
    if( !isset($aResult['error']) ) {
    
        switch($function) {
            case 'getSideBar':
    
                $sbBuilder = new sbBuilder();
    
                $success = true;
            
                $data = $sbBuilder->createSideBar($sbBuilder->sideBarArray);
        
                $aResult['result'] = $data;
                $aResult['success'] = $success;
            
               break;
    
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }
    
    }
    
    echo json_encode($aResult);

}









