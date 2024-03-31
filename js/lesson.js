function attachSideBar(_viewModel){
    var task = new Task({functionName : 'attachSideBar', viewModel : _viewModel}, 'Controller/apiController.php', function(response){

        var mainContent = document.getElementById("mainContent");
        var sideBar = document.getElementById("sideContent")
    
        if (sideBar == null){

            sideBar = response.result;
            mainContentShiftRight();
            mainContent.insertAdjacentHTML("beforebegin", sideBar);
        }
        
    })

    buffer.append(task);
}


function removeSideBar() {

    var sideBar = document.getElementById("sideContent")

    sideBar.remove();
    document.getElementById("sideContentButton").remove();
    mainContentShiftLeft();

}