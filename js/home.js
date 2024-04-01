// create home page
// still needs a footer

function getHomeLayout(){
    var task = new Task({functionName : 'getLayout'}, 'Controller/homeController.php', function(response){

        flushLayout();

        navBar = document.getElementById('navBar');
        navBar.insertAdjacentHTML("afterend", response.result);
        mainContentShiftRight();
        
        console.log(response);
    })

    buffer.append(task);
}

function getHomeSideContent(){
    var task = new Task({functionName : 'getSideContent'}, 'Controller/homeController.php', function(response){

        var mainContent = document.getElementById("mainContent");
        var sideBar = document.getElementById("sideContent")
    
        if (sideBar == null){

            sideBar = response.result;
            mainContentShiftRight();
            mainContent.insertAdjacentHTML("beforebegin", sideBar);
        }

        console.log(response);
        
    })

    buffer.append(task);
}

function getHomeMainContent(){
    var task = new Task({functionName : 'getMainContent'}, 'Controller/homeController.php', function(response){

        var layout = document.getElementById("layout");

        mainContent = document.createTextNode(response.result);
        
        layout.replaceChild(mainContent, layout.lastChild);

        console.log(response);
        
    })

    buffer.append(task);
}




// function getFooter(){
//     var mainContent = document.getElementById("mainContent");

//     $.ajax({
//         type: 'POST',
//         url: 'Controller/mainContentController.php',
//         dataType: 'json',
//         data: {functionName: 'getFooter'},
//         success: function (obj){
//             if (!('error' in obj)){
//                 content = obj.result;
//                 mainContent.insertAdjacentHTML('beforeend', content);
//             }
//             else{
//                 console.log(obj.error);
//             }
//         },
//     }).fail(function(){
//         alert("The function call did not work\n\n");
//     })
// }


// function addButton(){
//     var mainContent = document.getElementById("mainContent");

//     $.ajax({
//         type: 'POST',
//         url: 'Controller/mainContentController.php',
//         dataType: 'json',
//         data: {functionName: 'addButton'},
//         success: function (obj){
//             if (!('error' in obj)){
//                 content = obj.result;
//                 mainContent.insertAdjacentHTML('beforeend', content);
//             }
//             else{
//                 console.log(obj.error);
//             }
//         },
//     }).fail(function(){
//         alert("The function call did not work\n\n");
//     })
// }




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


