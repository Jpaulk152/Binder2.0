<!DOCTYPE html>
<html lang="en">
<head>

    <title>Document</title>

    <?php 
        include $_SERVER['DOCUMENT_ROOT']."/exercisePHP/7/View/htmlBuilder.php";;
        general::includeViewport();
        general::includeMeta();
        general::includeStylesheets();
        general::includeJavascript();
    ?>

</head>
<body>

<?php 

$navBuilder = new navBuilder();
echo $navBuilder->createNavBar($navBuilder->navBarArray);


// $sbBuilder = new sbBuilder($sbBuilder->sideBarArray);
// echo $sbBuilder->createSideBar($sbBuilder->sideBarArray);


$contentBuilder = new contentBuilder();

$contentBuilder->initialize();

?>


<!-- <div class="mainContent w3-main w3-container" id="contentToRefresh">

</div> -->
    
</body>
</html>