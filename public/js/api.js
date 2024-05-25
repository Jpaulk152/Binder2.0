
function replace(target, element)
{
    document.getElementById(target).replaceChildren(element);
}

function update(parameters, target='mainContent')
{
    var task = new Task(parameters, 'api/update', function(response){

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


    var task = new Task({entity: entity, values: values}, 'api/create', function(response){

        // console.log(response);

        document.getElementById(target).innerHTML = response;
        
    }, 'POST')

    buffer.append(task);
}




function read(parameters, target='mainContent')
{
    var task = new Task(parameters, 'api/read', function(response){

        // console.log(response);

        document.getElementById(target).innerHTML = response;

    }, 'POST')

    buffer.append(task);
}










function update(entity, id)
{
    var task = new Task({entity: entity, id: id}, 'api/update', function(response){

        // console.log(response);

        document.getElementById(target).innerHTML = response;
        
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