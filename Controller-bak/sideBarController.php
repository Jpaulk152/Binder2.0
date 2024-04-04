<?php

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    header('Content-Type: application/json');

    $function = filter_input(INPUT_GET, 'functionName', FILTER_SANITIZE_URL);
    $aResult = array();

    // $aResult['error'] = 'no view model';
    // $aResult['success'] = false;

    // echo json_encode($aResult);

    if( !isset($function) ) { $aResult['error'] = 'No function name!'; }
    
    if( !isset($aResult['error']) ) {
    
        switch($function) {
            case 'getSideBar':
                
                $viewModel = new \ViewModel\lessonViewModel();
                $links = $viewModel->sideBarLinks;

                if ($viewModel  == null){
                    $aResult['error'] = 'no view model';
                    $aResult['success'] = false;
                    break;
                }

                $sideBarBuilder = new \ViewModel\Builder\sideBarBuilder();
                
                // Array used here is replaced with all lesson data user should be able to view
                $data = $sideBarBuilder->createSideBar($links);

                $success = true;

                // $data = "derp";
        
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









