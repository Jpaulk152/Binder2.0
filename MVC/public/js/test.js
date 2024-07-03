function getChildView(controller, childView)
{
    var task = new Task({view : childView}, controller+'/childView', function(response){

        if(response === '')
        {
            console.log(response);
        }
        else
        {
            attachChildView(childView, response);
        }
    })

    buffer.append(task);
}


function attachChildView(childView, content)
{

    switch(childView)
    {
        case 'nav':
            break;

        case 'side':
            var mainContent = document.getElementById("mainContent");
            var sideBar = document.getElementById("sideContent")
        
            if (sideBar == null){
                sideBar = content;
                mainContentShiftRight();
                mainContent.insertAdjacentHTML("beforebegin", sideBar);
            }
            break;

        default:

    }
}

function detachChildView(childView)
{
    switch(childView)
    {
        case 'nav':
            break;

        case 'side':
            removeSideBar();
            break;

        default:

    }
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

function flushMainContent(){
    document.getElementById("mainContent").textContent = "";
}


function mainContentShiftRight(){

    mainContent = document.getElementById('mainContent');

    mainContent.classList.add("mainContentToRight");        

}

function mainContentShiftLeft(){

    mainContent = document.getElementById('mainContent');

    mainContent.classList.remove("mainContentToRight");        

}


function changeContent(_url, style="", elementId = "mainContent"){

    switch (style){
        
        case "iframe":
            var iframe = document.createElement('iframe');
            iframe.src = _url;
            iframe.style.width="100%";
            iframe.style.height= "100%";
        
            if (document.getElementById(elementId).children.length == 0){
                document.getElementById(elementId).appendChild(iframe);
            }
            else {
                document.getElementById(elementId).replaceChild(iframe, document.getElementById(elementId).children[0]);
            }

            break;

        default:

        var testDiv = document.createElement('div');
    
            for (i = 0; i<200; i++){
                testDiv.innerHTML += makeid(100) + '<br><br>' + makeid(100) + '<br><br>' + makeid(100) + '<br><br>' + makeid(100);
            }
            
            
            if (document.getElementById(elementId).children.length == 0){
                document.getElementById(elementId).appendChild(testDiv);
            }
            else {
                document.getElementById(elementId).replaceChild(testDiv, document.getElementById(elementId).children[0]);
            }
    }


    function makeid(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
          counter += 1;
        }

        return result;
    }
}








function runTest(test)
{
    var task = new Task({}, 'test?'+test, function(response){

        alert(response);
    })

    buffer.append(task);
}


function testReplace(test, target)
{
    var task = new Task({}, 'test?'+test, function(response){

        var element = new DOMParser().parseFromString(response, "text/html").getElementById(target);

        replace(target, element);
    })

    buffer.append(task);
}


function replaceContent(target, controller, content)
{
    var task = new Task({}, controller+'?'+content, function(response){

        console.log(response);

        var element = new DOMParser().parseFromString(response, "text/html").getElementById(target);

        replace(target, element);
    })

    buffer.append(task);
}


function getView(view, target)
{
    var task = new Task({}, 'home?'+view, function(response){

        var element = new DOMParser().parseFromString(response, "text/html").getElementById(target);

        replace(target, element);
    })

    buffer.append(task);
}





function getTable(table)
{

    var task = new Task({table: table}, 'api/getTable?table='+table, function(response){

        // console.log(response);

        var element = new DOMParser().parseFromString(response, "text/html").getElementById('mainContent');

        replace('mainContent', element);
    }, 'POST')

    buffer.append(task);
}

function form()
{
    var task = new Task({}, 'apiForm', function(response){

        // console.log(response);

        insertDebug('getDebug', response, '', '');

        var element = new DOMParser().parseFromString(response, "text/html").getElementById('mainContent');

        replace('mainContent', element);
    })

    buffer.append(task);
}


