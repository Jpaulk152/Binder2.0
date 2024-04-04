// 1. Buffer class has a public append method that expects some kinds of Task.
// 2. Buffer constructor expects a handler which is a method that takes an ajax task and a callback.
// 3. Buffer expects the handler to deal with the ajax and run the callback when it's finished.

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
});

// var buffer = new Buffer(loadTaskHandler);

// for (i = 0; i < loadingItems.length; i++){
//     // title attribute is the URL to get
//     var ajaxURL = loadingItems[i].attr("title") + '?ajaxPageContent=';
//     buffer.append(new Task(loadingItems[i], ajaxURL));
// }