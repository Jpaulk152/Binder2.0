
function update(parameters, target='mainContent')
{
    var task = new Task(parameters, 'api/update', function(response){

        console.log(response);

        var element = new DOMParser().parseFromString(response, "text/html").getElementById(target);

        // console.log(element);

        replace(target, element);

    }, 'POST')

    buffer.append(task);
}



function create(event)
{

    // alert('here');

    event.preventDefault();

    const entity = document.getElementById('name').innerText;

    const data = new FormData(event.target.form);

    const values = Object.fromEntries(data.entries());


    var task = new Task({entity: entity, values: values}, 'api/create', function(response){

        console.log(response);

        var element = new DOMParser().parseFromString(response, "text/html").getElementById('mainContent');

        replace('mainContent', element);
        
    }, 'POST')

    buffer.append(task);
}




function read(parameters, target='mainContent')
{
    var task = new Task(parameters, 'api/read', function(response){

        // console.log(response);

        var element = new DOMParser().parseFromString(response, "text/html").getElementById(target);

        // console.log(element);

        replace(target, element);

    }, 'POST')

    buffer.append(task);
}










function update(entity, id)
{
    var task = new Task({entity: entity, id: id}, 'api/update', function(response){

        console.log(response);

        // var element = new DOMParser().parseFromString(response, "text/html").getElementById('mainContent');

        // replace('mainContent', element);
    }, 'POST')

    buffer.append(task);
}






function del(entity, id)
{
    var task = new Task({entity: entity, id: id}, 'api/delete', function(response){

        console.log(response);

        // var element = new DOMParser().parseFromString(response, "text/html").getElementById('mainContent');

        // replace('mainContent', element);
    }, 'POST')

    buffer.append(task);
}