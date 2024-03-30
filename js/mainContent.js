// create home page
// still needs a footer

function getHome() {

    var mainContent = document.getElementById("mainContent");
    _arguments = ['resources/BioCantwell.JPG'];

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionName: 'getHome', arguments: JSON.stringify(_arguments)},
        success: function (obj){

            if (!('error' in obj)){

                flushMainContent();
                content = obj.result;
                mainContent.insertAdjacentHTML('beforeend', content);
            }
            else{
                console.log(obj.error);
            }

        },
    }).fail(function(){
        alert("The ajax call did not work\n\n");
    })
}

function getBio(){
    var mainContent = document.getElementById("mainContent");
    _arguments = ['resources/BioCantwell.JPG'];

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionName: 'getBio', arguments: JSON.stringify(_arguments)},
        success: function (obj){
            if (!('error' in obj)){
                content = obj.result;
                mainContent.insertAdjacentHTML('beforeend', content);
            }
            else{
                console.log(obj.error);
            }
        },
    }).fail(function(){
        alert("The function call did not work\n\n");
    })
}


function getBody(){
    var mainContent = document.getElementById("mainContent");

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionName: 'getBody'},
        success: function (obj){
            if (!('error' in obj)){
                content = obj.result;
                mainContent.insertAdjacentHTML('beforeend', content);
            }
            else{
                console.log(obj.error);
            }
        },
    }).fail(function(obj){
        alert("The function call did not work\n\n");
    })
}

function getFooter(){
    var mainContent = document.getElementById("mainContent");

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionName: 'getFooter'},
        success: function (obj){
            if (!('error' in obj)){
                content = obj.result;
                mainContent.insertAdjacentHTML('beforeend', content);
            }
            else{
                console.log(obj.error);
            }
        },
    }).fail(function(){
        alert("The function call did not work\n\n");
    })
}


function addButton(){
    var mainContent = document.getElementById("mainContent");

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionName: 'addButton'},
        success: function (obj){
            if (!('error' in obj)){
                content = obj.result;
                mainContent.insertAdjacentHTML('beforeend', content);
            }
            else{
                console.log(obj.error);
            }
        },
    }).fail(function(){
        alert("The function call did not work\n\n");
    })
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