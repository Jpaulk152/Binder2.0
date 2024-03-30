

function apiRequest(_type, _url, _functionName, _viewModel, _arguments){
    
    $.ajax({
        type: _type,
        url: _url,
        dataType: 'json',
        data: {functionName: _functionName, viewModel: _viewModel, arguments: JSON.stringify(_arguments)},
        success: function (reponse){

            if (!('error' in reponse)){
                reponse.result;
            }
            else{
                console.log(response.error);
                return false;
            }

        },
    }).fail(function(){
        alert("The ajax call did not work\n\n");
    })
}

function getHome() {

    var mainContent = document.getElementById("mainContent");
    _arguments = ['resources/BioCantwell.JPG'];

    $.ajax({
        type: 'POST',
        url: 'Controller/mainContentController.php',
        dataType: 'json',
        data: {functionName: 'getHome', arguments: JSON.stringify(_arguments)},
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
        alert("The ajax call did not work\n\n");
    })
}


function attachSideBar(_viewModel) {

    var mainContent = document.getElementById("mainContent");
    var sideBar = document.getElementById("sideContent")

    if (sideBar == null){

        response = apiRequest('GET', 'Controller/apiController.php', 'attachSideBar', _viewModel);

        if (response){
            sideBar = response.result;
            mainContentShiftRight();
            mainContent.insertAdjacentHTML("beforebegin", sideBar);
        }
        else{
            alert("sideBar call did not work");
            console.log(response);
        }
    }
}