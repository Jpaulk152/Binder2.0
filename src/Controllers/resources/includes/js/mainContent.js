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
