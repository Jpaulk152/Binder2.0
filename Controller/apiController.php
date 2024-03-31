<?php

require_once('../Autoloader.php');

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    header('Content-Type: application/json');

    $function = filter_input(INPUT_GET, 'functionName', FILTER_SANITIZE_URL);
    $viewModel = filter_input(INPUT_GET, 'viewModel', FILTER_SANITIZE_URL);
    $aResult = array();

    $success = false;

    if( !isset($function) ) { $aResult['error'] = 'No function name!'; }
    
    if( !isset($aResult['error']) ) {
    
        switch($function) {
            case 'attachSideBar':
    
                switch($viewModel){
                    case 'lesson':
                            $lessonViewModel = new lessonViewModel();
                            $aResult['result'] = $lessonViewModel->renderSideBar(); 
                            $success = true;
                        break;

                    default:
                }

                $aResult['success'] = $success;
            
               break;
    
            default:
               $aResult['error'] = 'Not found function '.$_GET['functionName'].'!';
               break;
        }
    
    }
    
    echo json_encode($aResult);

}


// switch($function) {
//     case 'getHome':

//         $arguments = json_decode(filter_input(INPUT_POST, 'arguments', FILTER_SANITIZE_URL));
//         if( !isset($arguments) ) { $aResult['error'] = 'No arguments!'; }

//         $imagePath = $arguments[0];
//         if( !isset($imagePath ) ) 
//         { 
//             $aResult['error'] = 'No path to image!'; 
//             break; 
//         }

//         $mainContentBuilder = new mainContentBuilder();


//         $data = $mainContentBuilder->createImageCard($imagePath, $c1, $c2, $c3);

//         $data .= $mainContentBuilder->createPanelContent($p1);
//         $data .= $mainContentBuilder->createPanelContent($p2);
        
        
//         $aResult['result'] = $data;
//         $aResult['success'] = true;
    
//        break;

//     case 'getBio':
        
//         $arguments = json_decode(filter_input(INPUT_POST, 'arguments', FILTER_SANITIZE_URL));
//         if( !isset($arguments) ) { $aResult['error'] = 'No arguments!'; }

//         $imagePath = $arguments[0];
//         if( !isset($imagePath ) ) 
//         { 
//             $aResult['error'] = 'No path to image!'; 
//             break; 
//         }

//         $mainContentBuilder = new mainContentBuilder();

//         $data = $mainContentBuilder->createImageCard($imagePath, $c1, $c2, $c3);                


//         $aResult['result'] = $data;
//         $aResult['success'] = true;
    
//        break;

//     case 'getBody':
      
//         $mainContentBuilder = new mainContentBuilder();

//         $data = $mainContentBuilder->createPanelContent($p1);
        
//         $aResult['result'] = $data;
//         $aResult['success'] = true;
    
//        break;

//     case 'getFooter':
        
//         $mainContentBuilder = new mainContentBuilder();

//         $data = $mainContentBuilder->createPanelContent($p2);
        
//         $aResult['result'] = $data;
//         $aResult['success'] = true;
    
//         break;

//     case 'addButton':


//         $mainContentBuilder = new mainContentBuilder();

//         $data = $mainContentBuilder->createButtonContent("Open", "javascript:sideBar('open')", "", "float:left");

//         $data .= $mainContentBuilder->createButtonContent("Close", "javascript:sideBar('close')");
        

//         $aResult['result'] = $data;
//         $aResult['success'] = true;
    
//        break;

//     default:
//        $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
//        break;
// }