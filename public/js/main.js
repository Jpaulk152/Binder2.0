function openSideBar(main = 'mainView', side = 'side', width = '400px') {
    document.getElementById(main).style.marginLeft = width;

    side = document.getElementById(side);
    side.children[1].style.width = width;
    // side.children[1].classList.add('w3-sidebar');
    side.children[1].style.display = 'block';
}

function closeSideBar(main = 'mainView', side = 'side') {
    main = document.getElementById(main).style.marginLeft = '0';

    side = document.getElementById(side);
    // side.children[1].classList.remove('w3-sidebar');
    side.children[1].style.display = 'none';
}



function expand(element){

    var accordian = element.nextSibling;

    var caret = element.children[0];

    // var caret = document.getElementById(element.id + '-caret');

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


function removeSideBar() {

    var sideBar = document.getElementById("sideContent")
    sideBar.remove();
    document.getElementById("sideContentButton").remove();
    mainContentShiftLeft();

}