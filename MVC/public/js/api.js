class Buffer {
    constructor(handler) {
        var queue = [];

        function run() {
            var callback = function () {
                // when the handler says it's finished it runs the callback.
                // in the callback we check for more tasks in the queue and if there are any we run again.
                if (queue.length > 0) {
                    run();
                }
            };
            // give the first item and the callback to the handler.
            handler(queue.shift(), callback);
        }

        // push the task to the queue. If the queue was empty before the task was pushed
        // we run the task.
        this.append = function (task) {
            queue.push(task);
            if (queue.length === 1) {
                run();
            }
        };
    }
}

var buffer;
$(document).ready(function(){
    buffer = new Buffer(ajaxTaskHandler);

    lastResponse = '';
});

// small Task containing item, URL, and optional callback
class Task {
    constructor(url, data, callback, type='GET') {
        this.type = type;
        this.data = data;
        this.url = url;
        this.callback = callback;
    }
}

// small handler that loads the task.url into the task.item and calls the callback
// when its finished
function loadTaskHandler(task, callback){
    $(task.data).load(task.url, function(){
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
        data: task.data,
        success: function(response){
            if(task.callback) task.callback(response);
            callback();
        }
        
    }).fail(function(response){
        
        insertDebug('ajaxTaskHandler', JSON.stringify(response), '', '');

        console.log(response);

    }).always(function(response){

        if (response.status == 300)
        {
            insertDebug('ajaxTaskHandler', JSON.stringify(response), '', '');

            console.log(response);
        }
    })
}










function replace(target, element)
{
    document.getElementById(target).replaceChildren(element);
}


function update(parameters, target='mainContent')
{
    var task = new Task('api/update', parameters, function(response){

        console.log(response);

        // console.log(response);

        document.getElementById(target).innerHTML = response;

    }, 'POST')

    buffer.append(task);
}



function create(event, target='mainContent')
{

    // alert('here');

    event.preventDefault();

    const entity = document.getElementById('name').innerText;

    const data = new FormData(event.target.form);

    const values = Object.fromEntries(data.entries());


    var task = new Task('api/create', {entity: entity, values: values}, function(response){

        // console.log(response);

        document.getElementById(target).innerHTML = response;
        
    }, 'POST')

    buffer.append(task);
}



function read(parameters, view, target='view3')
{
    var task = new Task('api/read', parameters, function(response){

        console.log(response);

        document.getElementById(target).innerHTML = response;

    }, 'POST')

    buffer.append(task);
}



// function api(controller, func, targets, parameters)
function api(event, parameters)
{
    console.log(event);

    if (parameters.hasOwnProperty('controller') && parameters.hasOwnProperty('function') && parameters.hasOwnProperty('parameters') && parameters.hasOwnProperty('targets'))
    {
        controller = parameters['controller'];
        func = parameters['function'];
        targets = parameters['targets'];
        parameters = parameters['parameters'];
        

        // console.log(targets);

        var task = new Task('api/' + controller + '/' + func, parameters, function(response){

            console.log(response);
    
            len = (response.length > targets.length) ? targets.length : response.length;
            for(var i = 0; i < len; i++)
            {
                document.getElementById(targets[i]).innerHTML = response[i];
            }
    
        }, 'POST')
    
        buffer.append(task);
    }
    else
    {
        console.log('incorrect parameters');
    }
}
