// COMMENTS!!!


function expand(element){
    
    accordian = element.nextSibling;

    var caret = document.getElementById(element.id + '-caret');

    console.log(caret);

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


function accordian(element) {

    accordian = element.nextSibling;

    var caret = document.getElementById(element.id + '-caret');

    

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

function removeSideBar() {

    var sideBar = document.getElementById("sideContent")

    sideBar.remove();
    document.getElementById("sideContentButton").remove();
    mainContentShiftLeft();

}