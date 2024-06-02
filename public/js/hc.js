

function hcMenu(parameters, target)
{
    var task = new Task('api/hc/menu', parameters, function(response){

        var response = new DOMParser().parseFromString(response, "text/html").getElementById(target);

        if(response)
        {
            var view = document.getElementById(target);
            if(view)
            {
                view.replaceWith(response);
            }
            else
            {
                var nav = document.getElementById('nav');
                nav.insertAdjacentElement('beforebegin', response);
            }

            openSideBar();
        }
       

    }, 'POST')

    buffer.append(task);
}

$(document).ready(function(){
    lastResponse = '';
});

function hcPageContent(parameters, target, event)
{
    var task = new Task('api/hc/pageContent', parameters, function(response){

        // console.log(response);

        if (response != lastResponse)
        {
            lastResponse = response;
            var response = new DOMParser().parseFromString(response, "text/html").getElementById(target);

            document.getElementById(target).innerHTML = response;

            var view = document.getElementById(target);
            if(view)
            {
                view.replaceWith(response);
            }
            else
            {
                document.body.firstChild.appendChild(response);
            }

            openSideBar();
        }

    }, 'POST')

    buffer.append(task);
}

function hc(event, parameters)
{
    // console.log(event);

    if (parameters.hasOwnProperty('controller') && parameters.hasOwnProperty('function') && parameters.hasOwnProperty('parameters') && parameters.hasOwnProperty('targets'))
    {
        func = parameters['function'];
        targets = parameters['targets'];
        parameters = parameters['parameters'];
        

        // console.log(targets);

        var task = new Task('api/hc' + '/' + func, parameters, function(response){

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