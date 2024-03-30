<?php

include $_SERVER['DOCUMENT_ROOT']."/exercisePHP/7/View/htmlBuilder.php";


static $p1 = "Welcome to Jeanne M. Holm Center for Officer Accessions and Citizen Development. Our mission is straight-forward: <strong>“We build leaders.”</strong>  The Holm Center vision of the future to sustain “a diverse culture of leadership development focused on Continuous Learning, Enthusiasm, Pride, Compliance and Tradition” is what motivates us every day. <br><br>Holm Center provides coordinated leadership and policy direction for the Air Force's officer recruiting, training, and commissioning programs at Officer Training School and at Air Force ROTC detachments at 145 universities. About 80 percent of the new officers who enter the Air Force each year come through one of our two programs. Our staff also manages, supports and develops curriculum to train tomorrow's Air and Space Forces officers. <br><br>Holm Center also directs the Air Force's high school citizenship training program - Air Force Junior ROTC. We oversee 870 Air Force Junior ROTC units on high school campuses around the world. The aim of that program is to build better citizens for America. We do that today for over 85,000 cadets.<br><br>For More Info Call Toll Free 1-800-522-0033 <br>(Holm Center ext 7087, AFJROTC ext 7513, AFROTC ext 2091)<br>For questions related to this site or other Holm Center sites, Call (334) 953-3050 or email <a href=''>holmcenter.wings.support@us.af.mil&nbsp;</a>&nbsp;";

static $p2 = "NOTE:&nbsp; ROTC Cadets needing technical assistance are advised to work with detachment.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";

static $c1 = "Brigadier General Houston R. Cantwell";
static $c2 = "Commander, Holm Center";
static $c3 = '<a href="https://www.af.mil/About-Us/Biographies/Display/Article/2298672/houston-r-cantwell/" target="_blank" rel="noopener">Biography</a>';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    header('Content-Type: application/json');

    $function = filter_input(INPUT_POST, 'functionname', FILTER_SANITIZE_URL);
    
    $aResult = array();

    $aResult['success'] = false;

    if( !isset($function) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($aResult['error']) ) {
    

        switch($function) {
            case 'getMainContent':

                $imagePath = filter_input(INPUT_POST, 'imagePath', FILTER_SANITIZE_URL);
                if( !isset($imagePath ) ) 
                { 
                    $aResult['error'] = 'No path to image!'; 
                    break; 
                }

                $contentBuilder = new contentBuilder();
    
                // $data = $contentBuilder->createImageCard($imagePath, $c1, $c2, $c3);

                $data = $contentBuilder->createImageCard($imagePath, $c1, $c2, $c3);

                $data .= $contentBuilder->createPanelContent($p1);
                $data .= $contentBuilder->createPanelContent($p2);
                
                
                $aResult['result'] = $data;
                $aResult['success'] = true;
            
               break;

            case 'getBio':
                $imagePath = filter_input(INPUT_POST, 'imagePath', FILTER_SANITIZE_URL);
                if( !isset($imagePath ) ) 
                { 
                    $aResult['error'] = 'No path to image!'; 
                    break; 
                }

                $contentBuilder = new contentBuilder();
    
                $data = $contentBuilder->createImageCard($imagePath, $c1, $c2, $c3);                
                
                $aResult['result'] = $data;
                $aResult['success'] = true;
            
               break;

            case 'getHomeBody':
              
                $contentBuilder = new contentBuilder();
    
                $data .= $contentBuilder->createPanelContent($p1);
                
                $aResult['result'] = $data;
                $aResult['success'] = true;
            
               break;

            case 'getHomeFooter':
                
                $contentBuilder = new contentBuilder();

                $data .= $contentBuilder->createPanelContent($p2);
                
                $aResult['result'] = $data;
                $aResult['success'] = true;
            
                break;

            case 'addButton':
    

                $contentBuilder = new contentBuilder();
    
                $success = true;

                $data .= $contentBuilder->createButtonContent("Open", "javascript:sideBar('open')", "", "float:left");

                $data .= $contentBuilder->createButtonContent("Close", "javascript:sideBar('close')");
                
        
                $aResult['result'] = $data;
                $aResult['success'] = true;
            
               break;
    
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }
    
    }
    
    echo json_encode($aResult);

}









