<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

#parent {
    width: 320px;
    height: 160px;
    background-color: black;
    margin: 150px auto;
    font-size: 0;
}

#child1 {
    width: 80px;
    height: 80px;
    background-color: orange;
    position: relative;
    top: 0px;
    left: 0px;
}
#child2 {
    width: 80px;
    height: 80px;
    background-color: blue;
    position: relative;
    top: 0px;
    left: 0px;
}
#child3 {
    width: 80px;
    height: 80px;
    background-color: green;
    position: relative;
    top: 0px;
    left: 0px;
}
#child4 {
    width: 80px;
    height: 80px;
    background-color: red;
    position: relative;
    top: 0px;
    left: 0px;
}

.children {
    display: inline-block;
}

</style>

<body>

<div id="parent">

<div class="children" id='child1'></div>
<div class="children" id='child2'></div>
<div class="children" id='child3'></div>
<div class="children" id='child4'></div>

</div>


</body>
</html>