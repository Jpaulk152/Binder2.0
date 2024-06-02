


// $parameters = array(
//     'controller'=>'hc',
//     'function'=>'menu',
//     'targets'=>array(
//         'view2'
//     ),
//     'parameters'=>array(
//         'filter'=>array(
//             'page_status'=>'true',
//             'page_inmenu'=>'true',
//             'page_parent'=>'none'
//         ),
//         'orderBy'=>'page_title',
//         'fields'=>array(
//             'page_title',
//             'page_id'
//         )
//     )
// );



function appMenu(parameters, target, event)
{
    var task = new Task('api/app/menu', parameters, function(response){

        // console.log(response);

        document.getElementById(target).innerHTML = response;

        content = document.getElementById('view3');
        if (!content.classList.contains("mainContentToRight"))
        {
            content.classList.add('mainContentToRight');
        }

    }, 'POST')

    buffer.append(task);
}

$(document).ready(function(){
    lastResponse = '';
});

function appPageContent(parameters, target, event)
{
    var task = new Task('api/app/pageContent', parameters, function(response){

        // console.log(response);

        if (response != lastResponse)
        {
            document.getElementById(target).innerHTML = response;
            lastResponse = response;
        }

    }, 'POST')

    buffer.append(task);
}

function app(parameters, event)
{
    // console.log(event);

    if (parameters.hasOwnProperty('controller') && parameters.hasOwnProperty('function') && parameters.hasOwnProperty('parameters') && parameters.hasOwnProperty('targets'))
    {
        func = parameters['function'];
        targets = parameters['targets'];
        parameters = parameters['parameters'];
        

        // console.log(targets);

        var task = new Task('api/app' + '/' + func, parameters, function(response){

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