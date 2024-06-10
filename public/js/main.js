
$(document).ready(function(){
    width = '400px';

    rows = document.getElementsByClassName('layout');
    columns = 3;

    for(i=0;i<rows.length;i++)
    {
        styles = window.getComputedStyle(rows[i], null);

        rowWidth = parseInt(styles.getPropertyValue('width')) - parseInt(styles.getPropertyValue('padding-left')) - parseInt(styles.getPropertyValue('padding-right')) - 20;

        colWidth = rowWidth / columns;
        elements = rows[i].children;

        for(j=0;j<elements.length;j++)
        {
            elements[j].style.width = colWidth + 'px';
        }
    }
});

function openSideBar(event) {

    sidebar = event.target.nextSibling;
    main = sidebar.parentElement.nextSibling;

    if (main && main.getAttribute('id') === 'main')
    {
        main.style.marginLeft = width;
    }

    sidebar.style.width = width;
    sidebar.style.display = 'block';
}

function closeSideBar(event) {

    sidebar = event.target.parentElement;
    width = sidebar.style.width;
    sidebar.style.display = 'none';

    sibling = sidebar.parentElement.nextSibling;
    if (sibling)
    {
        sibling.style.marginLeft = '0';
    }   
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