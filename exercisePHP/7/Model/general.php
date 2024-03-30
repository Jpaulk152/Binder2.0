<?php

    


    trait navBarTest{
        public $navBarArray = array(
            array("name" => "Holm Center", "link" => "javascript:home()"), 

            
            array("name" => "Testing Functions", "link" => "#Testing", 
        
            "menuItems" => array(
        
                    array("name" => "PHP Exercise 6", "link" => "javascript:changeContent('http://joey.dev.holmcenter.com/exercisePHP/6/index.php', 'iframe')"),
        
                    array("name" => "Random Text", "link" => "javascript:changeContent('#')"),

                    array("name" => "getBio", "link" => "javascript:getBio()"),

                    array("name" => "getHomeBody", "link" => "javascript:getHomeBody()"),

                    array("name" => "Flush Main Content", "link" => "javascript:flushMainContent()"),
        
                )), 

            array("name" => "Side Bar", "link" => "#Testing", 
    
            "menuItems" => array(

                    array("name" => "Open SideBar", "link" => "javascript:sideBar('open')"),

                    array("name" => "Close SideBar", "link" => "javascript:sideBar('close')"),
        
                )), 
                
        );
    }


    // word wrap or limit to 48 chars
    trait sideBarTest{   

        public $sideBarArray = array(

            array("name" => "Content with no Accordian", "link" => "#"), 

            array("name" => "Content with no Accordian", "link" => "#"), 
        
            array("name" => "Regular Accordian", "link" => "#",
                "menuItems" => array(
                    array("name" => "PHP Exercise 1", "link" => "javascript:changeContent('http://joey.dev.holmcenter.com/exercisePHP/1/index.php', 'iframe')"),
                    array("name" => "PHP Exercise 2", "link" => "javascript:changeContent('http://joey.dev.holmcenter.com/exercisePHP/2/index.html', 'iframe')"),
                    array("name" => "PHP Exercise 3", "link" => "javascript:changeContent('http://joey.dev.holmcenter.com/exercisePHP/3/index.html', 'iframe')"),
                    array("name" => "PHP Exercise 4", "link" => "javascript:changeContent('http://joey.dev.holmcenter.com/exercisePHP/4/index.html', 'iframe')"),
                    array("name" => "PHP Exercise 5", "link" => "javascript:changeContent('http://joey.dev.holmcenter.com/exercisePHP/5/index.php', 'iframe')"),
                    array("name" => "PHP Exercise 6", "link" => "javascript:changeContent('http://joey.dev.holmcenter.com/exercisePHP/6/index.php', 'iframe')"),
                    array("name" => "PHP Exercise 7", "link" => "javascript:changeContent('http://joey.dev.holmcenter.com/exercisePHP/7/index.php', 'iframe')"),
                    )
                ),

                array("name" => "Content with no Accordian", "link" => "#"), 
        
            array("name" => "Two Tier Accordian", "link" => "#", 
        
                "menuItems" => array(
            
                    array("name" => "Accordian2-0", "link" => "#", 
                        "menuItems" => array(
                            array("name" => "Sublink1", "link" => "#"),
                            array("name" => "Sublink2", "link" => "#"),
                            array("name" => "Sublink3", "link" => "#"
                            ),
                        )
                    ),
            
                    array("name" => "Link 1", "link" => "#"),
            
                    array("name" => "Link 2", "link" => "#")
            
                )), 

                array("name" => "Content with no Accordian", "link" => "#"), 
        
            array("name" => "Three Tier Accordian", "link" => "#", 
        
        
            "menuItems" => array(
        
        
                    array("name" => "Accordian3-0", "link" => "#", 
        
                        "menuItems" => array(
        
                            array("name" => "Sublink1", "link" => ""),
        
                            array("name" => "Sublink2", "link" => ""),
        
                            array("name" => "Accordian3-0-0", "link" => "#",
        
                                "menuItems" => array(
                                    array("name" => "Sublink1", "link" => "#"),
                                    array("name" => "Sublink2", "link" => "#"),
                                    array("name" => "Sublink3", "link" => "#"
                                    )
                                )
                            ),
                        )
                    ),
        
        
                    array("name" => "Link 1", "link" => "#"),
        
        
                    array("name" => "Link 2", "link" => "#", 
                    )
        
                )), 
        
        
            array("name" => "Four Tier Accordian", "link" => "#", 
        
            "menuItems" => array(
        
                    array("name" => "Accordian4-0", "link" => "#", 
                        "menuItems" => array(
                            array("name" => "Sublink1", "link" => "#"),
                            array("name" => "Sublink2", "link" => "#"),
                            array("name" => "Accordian4-0-0", "link" => "#",
                                "menuItems" => array(
                                    array("name" => "Sublink1", "link" => "#"),
                                    array("name" => "Sublink2", "link" => "#"),
                                    array("name" => "Accordian4-0-0-0", "link" => "#",
                                    "menuItems" => array(
                                        array("name" => "Sublink1", "link" => "#"),
                                        array("name" => "Sublink2", "link" => "#"),
                                        array("name" => "Sublink3", "link" => "#")
                                        )
                                    )
                                )
                            ),
                        )
                    ),

                    array("name" => "Accordian4-1", "link" => "#", 
                        "menuItems" => array(
                            array("name" => "Sublink1", "link" => "#"),
                            array("name" => "Sublink2", "link" => "#"),
                            array("name" => "Accordian4-0-0", "link" => "#",
                                "menuItems" => array(
                                    array("name" => "Sublink1", "link" => "#"),
                                    array("name" => "Sublink2", "link" => "#"),
                                    array("name" => "Accordian4-0-0-0", "link" => "#",
                                    "menuItems" => array(
                                        array("name" => "Sublink1", "link" => "#"),
                                        array("name" => "Sublink2", "link" => "#"),
                                        array("name" => "Sublink3", "link" => "#")
                                        )
                                    )
                                )
                            ),
                        )
                    ),
        
                    array("name" => "Link 2", "link" => "#"),
        
                    array("name" => "Link 3", "link" => "#", 
                    )
        
                ),
            ), 
            
        );

    }








    class general
    {

        public static function includeViewport($width="device-width", $initialScale="1") {
            echo '<meta name="viewport" content="width='.$width.', initial-scale='.$initialScale.'">';
        }

        public static function includeMeta(){
            echo '<meta charset="UTF-8">';
        }


        public static function includeStylesheets() {
            echo '<link rel="stylesheet" href="css/reset.css">';
            echo '<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">';
            echo '<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">';
            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
            echo '<link rel="stylesheet" href="css/main.css">';
        }

        public static function includeJavascript() {
            echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
            echo '<script src="js/sideBar.js"></script>';
            echo '<script src="js/mainContent.js"></script>';
        }

        public static function printInfo($msg){
            echo '<p class="w3-panel w3-yellow w3-round-xlarge">'.$msg.'</p>';
        }
    }



