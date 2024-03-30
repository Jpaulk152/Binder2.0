// COMMENTS!!!

function attachSideBar(_viewModel){
    var task = new Task({functionName : 'attachSideBar', viewModel : _viewModel}, 'Controller/apiController.php', function(result){

        var mainContent = document.getElementById("mainContent");
        var sideBar = document.getElementById("sideContent")
    
        if (sideBar == null){

            sideBar = result;
            mainContentShiftRight();
            mainContent.insertAdjacentHTML("beforebegin", sideBar);
        }
        
    })

    // var buffer = new Buffer(ajaxTaskHandler);
    buffer.append(task);
}


function removeSideBar() {

    var sideBar = document.getElementById("sideContent")

    sideBar.remove();
    document.getElementById("sideContentButton").remove();
    mainContentShiftLeft();

}


function accordian(id) {

    var accordian = document.getElementById(id);  
    var caret = document.getElementById(id + "-caret");

    // console.log(accordian);

    if(accordian.className.indexOf("w3-show") == -1) {

        accordian.className = accordian.className.replace("w3-hide", "w3-show");
        caret.className = caret.className.replace("fa-caret-right", "fa-caret-down");

        // fix animate closing accordian
        // setTimeout(function() {
        //     accordian.className = accordian.className.replace("w3-animate-zoom-out", "w3-animate-zoom-in");
        // }, 0)
                
    }
    else {

        recursiveClose(accordian);

        accordian.className = accordian.className.replace("w3-show", "w3-hide");
        caret.className = caret.className.replace("fa-caret-down", "fa-caret-right");

        // setTimeout(function() {
        //     accordian.className = accordian.className.replace("w3-animate-zoom-in", "w3-animate-zoom-out");
        // }, 0)

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