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

// On success it will refresh the right side of the page some content that may include an image
function readContent(_id) {

    var errorDetails;

    $.ajax({
        url: "process2.php",
        type: "get",
        dataType: "json",
        data: {id: _id},
        success: function(result){

            if (result.success){
                let contentToRefresh = document.getElementById("contentToRefresh");
                while(contentToRefresh.firstChild){
                    contentToRefresh.removeChild(contentToRefresh.lastChild);
                }

                const contentCard = document.createElement('div');

                if (result.image != null) {
                    const imageCard = document.createElement('img');
                    imageCard.className = "w3-image w3-round";
                    imageCard.style.width = "90%";
                    imageCard.style.margin = "80px";
                    imageCard.src = result.image;
                    contentToRefresh.appendChild(imageCard);
                }
             
                contentCard.className = "w3-border w3-card w3-center";
                contentCard.innerHTML = result.content;

            
                contentToRefresh.appendChild(contentCard);
                
            }
        }
    }).fail(function(){
        alert("The function call did not work\n\n" + errorDetails);
    })


}

function w3_open() {
    document.getElementById("sideContent").style.display = "block";
}

function w3_close() {
    document.getElementById("sideContent").style.display = "none";
}

function accordian(id) {
    var accordian = document.getElementById("accordian" + id);  
    var caret = document.getElementById("caret" + id)

    if(accordian.className.indexOf("w3-show") == -1) {
        accordian.className += " w3-show";
        caret.className = caret.className.replace("fa-caret-right", "fa-caret-down");

        console.log("caret" + id);
    }
    else {
        accordian.className = accordian.className.replace(" w3-show", "");
        caret.className = caret.className.replace("fa-caret-down", "fa-caret-right");
    }
}
