

function hcMenu(parameters, target)
{
    var task = new Task('api/hc/menu', parameters, function(response){

        // console.log(response[1]);

        
        var dom = new DOMParser().parseFromString(response[0]+response[1], "text/html");
        // console.log(dom);
        var response = dom.getElementById(target);
        var bundle = dom.getElementsByTagName('style')[0];

        // console.log(bundle);

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
                nav.insertAdjacentElement('afterend', response);
            }

            var body = document.getElementsByTagName('body')[0];
            body.insertAdjacentElement('afterend', bundle);

            openSideBar();

            // var task = new Task('api/home/insert', {id: response[0], entity: response[1], bundle: response[2]}, function(success){

            //     if (success)
            //     {
            //         openSideBar();
            //     }

            // }, 'POST');
            // buffer.append(task);
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

        if (response != lastResponse)
        {
            lastResponse = response;
            var dom  = new DOMParser().parseFromString(response, "text/html");

            var response = dom.getElementById(target);
            imgs = dom.getElementsByTagName('img');

            for (i=0; i<imgs.length; i++)
            {
                // console.log(imgs[i].src);
                path = imgs[i].src.split('media/')[1];

                imgs[i].src = '../public/media/' + path;

                // console.log(path);
            }

            

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

            // openSideBar(event);
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