<?php

require_once('../Autoloader.php');

$lessonController = new lessonController();

$lessonController->parseRequest();


class lessonController {

    public lessonViewModel $lessonViewModel;

    public function getLayout(){
        return $this->lessonViewModel->renderLayout(); 
    }

    public function getSideContent(){
        return $this->lessonViewModel->renderSideBar(); 
    }

    public function getMainContent(){
        // return $this->lessonViewModel->renderMainContent(); 

        return 'main content';
    }

    public function parseRequest(){

        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json');
        
            $function = filter_input(INPUT_GET, 'functionName', FILTER_SANITIZE_URL);
            $aResult = array();
        
            $success = false;
        
            if( !isset($function) ) { $aResult['error'] = 'No function name!'; }
            
            if( !isset($aResult['error']) ) {

                $this->lessonViewModel = new lessonViewModel();
            
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