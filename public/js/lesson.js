function getLessonLayout(){
    var task = new Task({functionName : 'getLayout'}, 'Controller/lessonController.php', function(response){

        flushLayout();

        navBar = document.getElementById('navBar');
        navBar.insertAdjacentHTML("afterend", response.result);
        mainContentShiftRight();
        
        console.log(response);
    })

    buffer.append(task);
}

function getLessonSideContent(){
    var task = new Task({functionName : 'getSideContent'}, 'Controller/lessonController.php', function(response){

        var mainContent = document.getElementById("mainContent");
        var sideBar = document.getElementById("sideContent")
    
        if (sideBar == null){

            sideBar = response.result;
            mainContentShiftRight();
            mainContent.insertAdjacentHTML("beforebegin", sideBar);
        }
        
    })

    buffer.append(task);
}

function getLessonMainContent(){
    var task = new Task({functionName : 'getMainContent'}, 'Controller/lessonController.php', function(response){

        var mainContent = document.getElementById("mainContent");
        var sideBar = document.getElementById("sideContent")
    
        if (sideBar == null){

            sideBar = response.result;
            mainContentShiftRight();
            mainContent.insertAdjacentHTML("beforebegin", sideBar);
        }
        
    })

    buffer.append(task);
}


