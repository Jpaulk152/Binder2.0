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