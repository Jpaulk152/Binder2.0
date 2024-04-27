
// small Task containing item, URL, and optional callback
class Task {
    constructor(item, url, callback, type='GET') {
        this.type = type;
        this.item = item;
        this.url = url;
        this.callback = callback;
    }
}

// small handler that loads the task.url into the task.item and calls the callback
// when its finished
function loadTaskHandler(task, callback){
    $(task.item).load(task.url, function(){
        // call an optional call from the Task
        if (task.callback) task.callback();
        //call the buffer callback.
        callback();
    })
}

function ajaxTaskHandler(task, callback){
    
    $.ajax({
        type: task.type,
        url: task.url,
        dataType: 'json',
        data: task.item,
        success: function(response){
            if(task.callback) task.callback(response);
            callback();
        }
        
    }).fail(function(response){
        
        alert("The ajax call did not work\n\n");
        console.log(response);

    })

}