// create home page
// still needs a footer
function home() {

    var mainContent = document.getElementById("mainContent");

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionname: 'getMainContent', imagePath: "resources/BioCantwell.JPG"},
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
        alert("The function call did not work\n\n");
    })
}

function getBio(){
    var mainContent = document.getElementById("mainContent");

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionname: 'getBio', imagePath: "resources/BioCantwell.JPG"},
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

function getBio(){
    var mainContent = document.getElementById("mainContent");

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionname: 'getBio', imagePath: "resources/BioCantwell.JPG"},
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

function getHomeBody(){
    var mainContent = document.getElementById("mainContent");

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionname: 'getHomeBody'},
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