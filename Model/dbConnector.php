<?php

    // namespace Model;

    // require_once "sqlConfig.php";
    // require_once('../Autoloader.php');

    class dbConnector {

        protected $conn;

        protected $fields;

        private $sqlQuery;

        // Fields should be required when not mocking
        function __construct(array $_fields = [])
        {
            $this->connect(sqlConfig::$serverName, sqlConfig::$databaseName, sqlConfig::$userName, sqlConfig::$password);

            $this->fields = $_fields;

            $totalFields = count($this->fields); $i = 0;
            $this->sqlQuery = 'SELECT ';
            foreach ($this->fields as $f){
                if (++$i === $totalFields){
                    $this->sqlQuery .= $f . ' FROM';
                }
                else{
                    $this->sqlQuery .= $f . ', ';
                }
            }
        }

        function __destruct()
        {
            $this->conn = null;
        }

        protected function connect($serverName, $databaseName, $userName, $password){

            // try{
            //     $this->conn = new PDO('mysql:host='.$serverName.';dbname='.$databaseName.'"', $userName, $password);

            //     // set the PDO error mode to exception
            //     $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //     echo "Connected Successfully";
            // }
            // catch(PDOException $e){
            //     // echo "Connection Failed: " . $e->getMessage();

            //     echo "Hit dbConnector->connect catch block";
            // }

        }


        function mockExec($table){

            switch($table){

                case 'navLinks':
                        return $this->navLinks;
                    break;
    
                case 'sideBarLinks':
                        return $this->sideBarLinks;
                    break;
    
                case 'mainContent';
                        return $this->mainContent;
                    break;
    
                default:
    
                    return false;
    
            }

        }


        private $navLinks = array(

            array("name" => "Holm Center", "link" => "index.php"), 
        
            array("name" => "Testing Functions", "link" => "#Testing", 
        
            "menuItems" => array(

                    array("name" => "Curriculum Page", "link" => "curriculum.php"),

                    array("name" => "Lesson Page", "link" => "lesson.php"),
        
                    array("name" => "PHP Exercise 6", "link" => "javascript:changeContent('../exercisePHP/6/index.php', 'iframe')"),
        
                    array("name" => "Random Text", "link" => "javascript:changeContent('#')"),
        
                    array("name" => "getHomeContent", "link" => "javascript:getHomeContent()"),
                    
                    array("name" => "addButton", "link" => "javascript:addButton()"),
        
                    array("name" => "Flush Main Content", "link" => "javascript:flushMainContent()"),
        
                )), 
        
            array("name" => "Side Bar", "link" => "#Testing", 
        
            "menuItems" => array(
        
                    array("name" => "Attach Lesson SideBar", "link" => "javascript:attachSideBar('lesson')"),
        
                    array("name" => "Remove SideBar", "link" => "javascript:removeSideBar()"),
        
                )), 
                
        );
        
    
        private $mainContent = array(
            'welcome'=>'Welcome to the Jeanne M. Holm Center for Officer Accessions & Citizen Development.',
            'imagePath'=>'resources/BioCantwell.JPG',
            'p1'=>"Welcome to Jeanne M. Holm Center for Officer Accessions and Citizen Development. Our mission is straight-forward: <strong>“We build leaders.”</strong>  The Holm Center vision of the future to sustain “a diverse culture of leadership development focused on Continuous Learning, Enthusiasm, Pride, Compliance and Tradition” is what motivates us every day. <br><br>Holm Center provides coordinated leadership and policy direction for the Air Force's officer recruiting, training, and commissioning programs at Officer Training School and at Air Force ROTC detachments at 145 universities. About 80 percent of the new officers who enter the Air Force each year come through one of our two programs. Our staff also manages, supports and develops curriculum to train tomorrow's Air and Space Forces officers. <br><br>Holm Center also directs the Air Force's high school citizenship training program - Air Force Junior ROTC. We oversee 870 Air Force Junior ROTC units on high school campuses around the world. The aim of that program is to build better citizens for America. We do that today for over 85,000 cadets.<br><br>For More Info Call Toll Free 1-800-522-0033 <br>(Holm Center ext 7087, AFJROTC ext 7513, AFROTC ext 2091)<br>For questions related to this site or other Holm Center sites, Call (334) 953-3050 or email <a href=''>holmcenter.wings.support@us.af.mil&nbsp;</a>&nbsp;",
            'p2'=>'NOTE:&nbsp; ROTC Cadets needing technical assistance are advised to work with detachment.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;',
    
            'b1'=>'Brigadier General Houston R. Cantwell',
            'b2'=>'Commander, Holm Center',
            'b3'=>'<a href="https://www.af.mil/About-Us/Biographies/Display/Article/2298672/houston-r-cantwell/" target="_blank" rel="noopener">Biography</a>'
        );
    
    
        private $sideBarLinks = array(
        
            array("name" => "Regular Accordian", "link" => "#",
                "menuItems" => array(
                    array("name" => "PHP Exercise 1", "link" => "javascript:changeContent('../exercisePHP/1/index.php', 'iframe')"),
                    array("name" => "PHP Exercise 2", "link" => "javascript:changeContent('../exercisePHP/2/index.html', 'iframe')"),
                    array("name" => "PHP Exercise 3", "link" => "javascript:changeContent('../exercisePHP/3/index.html', 'iframe')"),
                    array("name" => "PHP Exercise 4", "link" => "javascript:changeContent('../exercisePHP/4/index.html', 'iframe')"),
                    array("name" => "PHP Exercise 5", "link" => "javascript:changeContent('../exercisePHP/5/index.php', 'iframe')"),
                    array("name" => "PHP Exercise 6", "link" => "javascript:changeContent('../exercisePHP/6/index.php', 'iframe')"),
                    array("name" => "PHP Exercise 7", "link" => "javascript:changeContent('../exercisePHP/7/index.php', 'iframe')"),
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

?>