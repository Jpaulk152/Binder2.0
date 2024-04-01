<?php

require_once('../Autoloader.php');

$homeController = new homeController();

$homeController->parseRequest();


class homeController {

    public homeViewModel $homeViewModel;

    public function getLayout(){
        return $this->homeViewModel->renderLayout(); 
    }

    public function getSideContent(){
        return $this->homeViewModel->renderSideBar(); 
    }

    public function getMainContent(){
        return $this->homeViewModel->renderMainContent(); 
    }

    public function parseRequest(){

        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json');
        
            $function = filter_input(INPUT_GET, 'functionName', FILTER_SANITIZE_URL);
            $aResult = array();
        
            $success = false;
        
            if( !isset($function) ) { $aResult['error'] = 'No function name!'; }
            
            if( !isset($aResult['error']) ) {

                $this->homeViewModel = new homeViewModel();
            
                switch($function) {

                    case 'getLayout':
                        $aResult['result'] = $this->getLayout(); 
                        $success = true;
                        
                        break;

                    case 'getSideContent':
            
                        $aResult['result'] = $this->getSideContent(); 
                        $success = true;
                    
                       break;

                    case 'getMainContent':
        
                        $aResult['result'] = $this->getMainContent(); 
                        $success = true;
                
                    break;
            
                    default:
                       $aResult['error'] = 'Not found function '.$_GET['functionName'].'!';
                       break;
                }
            
            }

            $aResult['success'] = $success;
            
            echo json_encode($aResult);
        
        }
    }
}