<?php

require_once('../Autoloader.php');

// Holds data like $baseUrl etc.
// include '../config.php';

$requestURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// echo $requestURL;

echo config::baseURL();

// $requestString = trim(substr($requestURL, strlen(config::baseURL())), 'Controller/homeController.php/');
// // echo $requestString;

// $urlParams = explode('/', $requestString);
// // echo var_dump($urlParams);

// // TODO: Consider security (see comments)
// $controllerName = ucfirst(array_shift($urlParams)).'Controller';
// $actionName = strtolower(array_shift($urlParams)).'Action';

// echo $controllerName . '<br>';
// echo $actionName;

// // Here you should probably gather the rest as params

// // Call the action
// $controller = new $controllerName;
// $controller->$actionName();









// if ($_SERVER["REQUEST_METHOD"] == "GET"){
//     header('Content-Type: application/json');

//     $function = filter_input(INPUT_GET, 'functionName', FILTER_SANITIZE_URL);
//     $aResult = array();

//     $success = false;

//     if( !isset($function) ) { $aResult['error'] = 'No function name!'; }
    
//     if( !isset($aResult['error']) ) {
    
//         switch($function) {
//             case 'getMainContent':
    
//                 $homeViewModel = new homeViewModel();
//                 $aResult['result'] = $homeViewModel->renderMainContent();
                
//                 $success = true;

//                break;
    
//             default:
//                 $aResult['error'] = 'Not found function '.$_GET['functionName'].'!';
//         }
    
//     }

//     $aResult['success'] = $success;
    
//     echo json_encode($aResult);

// }
