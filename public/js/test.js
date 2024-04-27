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

function removeSideBar() {

    var sideBar = document.getElementById("sideContent")
    sideBar.remove();
    document.getElementById("sideContentButton").remove();
    mainContentShiftLeft();

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


function expand(element){
    
    accordian = element.nextSibling;

    var caret = document.getElementById(element.id + '-caret');

    // console.log(caret);

    if(accordian.className.indexOf("w3-show") == -1) {

        accordian.className = accordian.className.replace("w3-hide", "w3-show");
        caret.className = caret.className.replace("fa-caret-right", "fa-caret-down");
    
    }
    else {

        recursiveClose(accordian);

        accordian.className = accordian.className.replace("w3-show", "w3-hide");
        caret.className = caret.className.replace("fa-caret-down", "fa-caret-right");

    }
}



function recursiveClose(node) {
    for (var i=0; i<node.childNodes.length; i++){
        var child = node.childNodes[i];
        recursiveClose(child);

        // console.log(child + "  " + child.classList);
        if (typeof(child.classList) != "undefined"){
            if (child.classList.contains("accordian")){
                child.classList.replace("w3-show", "w3-hide");
            }
            if (child.classList.contains("caret")){
                child.classList.replace("fa-caret-down", "fa-caret-right");
            }
        }

    }
}


function openSideBar() {
    document.getElementById("sideContent").style.display = "block";
}

function closeSideBar() {
    document.getElementById("sideContent").style.display = "none";
}



function runTest(test)
{
    var task = new Task({}, 'test?'+test, function(response){

        alert(response);
    })

    buffer.append(task);
}