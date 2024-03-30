// On success it will refresh the right side of the page with the color it got from the server.
function changeBackgroundColor(selection)
{
    const errorMsg = "Something went wrong."
    const errorMsg2 = "";
    
    let id = selection;

        $.ajax({
        url: "colors.php",
        type: "get",
        dataType: "json",
        data: {color: id},
        success: function(result){
            
            if (result.success){
                
                

                let contentToRefresh = document.getElementById("contentToRefresh");

                var lastClass = contentToRefresh.className.split(" ").pop();

                contentToRefresh.className = contentToRefresh.className.replace(lastClass, result.color);

            }

        }
        
    }).fail(function(){
        alert(errorMsg + " Resetting now.\n\n" + errorMsg2);
    })

}   



function w3_open() {
    document.getElementById("sideContent").style.display = "block";
}

function w3_close() {
    document.getElementById("sideContent").style.display = "none";

    document.getElementById("mainContent").classList.remove("mainContentToRight");
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

function sideBar($option) {

    var mainContent = document.getElementById("mainContent");
    var sideBar = document.getElementById("sideContent")

    switch ($option){
        case "open":

            if (sideBar == null){
                $.ajax({
                    type: "GET",
                    url: "Controller/sideBarController.php",
                    dataType: "json",
                    data: {functionname: 'getSideBar'},
                    success: function (obj){
            
                        sideBar = obj.result;
        
                        mainContent.classList.add("mainContentToRight");
                        mainContent.insertAdjacentHTML("beforebegin", sideBar);
            
                    },
                })
            }

            break;

        case "close":

            
            sideBar.remove();
            document.getElementById("sideContentButton").remove();
            mainContent.classList.remove("mainContentToRight");

        default:

        
    }

  
}
