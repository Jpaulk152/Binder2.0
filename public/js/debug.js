
containerStyles = [
    'word-break: break-all;',
    'box-sizing: border-box !important;',
    'font-size: 20px !important;',
    'z-index: 99 !important;',
    'color: black !important;',
    'position: fixed !important;',
    'top: 80px !important;',
    'right: 10px !important;',
    'background-color: white !important;',
    'min-width: 800px !important;',
    'max-width: 1000px !important;',
    'max-height: 500px !important;',
    'border-radius: 15px !important;',
    'padding: 20px !important;',
    'margin: 30px !important;',
    'overflow-y: auto !important;',
    'border: 10px solid black;'
]


debugStyles = [
    'word-break: break-all;',
    'box-sizing: border-box !important;',
    'font-size: 20px !important;',
    'color: white !important;',
    'background-color: black !important;',
    'min-width: 600px !important;',
    'max-width: 800px !important;',
    'max-height: 400px !important;',
    'border-radius: 15px !important;',
    'padding: 30px !important;',
    'margin: 30px !important;',
    'border: 10px solid black;',
    'overflow-y: auto !important;'
]


function insertDebug(from='', content='', type='', count='')
{
    debugContainer = document.getElementById('debugContainer');
    if (debugContainer === null)
    {
        debugContainer = document.createElement('div');
        debugContainer.innerHTML = '<h3>Debugger</h3>';
        debugContainer.id = 'debugContainer';

        containerStyles.forEach(function(item){
            debugContainer.style.cssText += item;
        });

        document.getElementsByTagName('body')[0].appendChild(debugContainer)
    }

    div = document.createElement('div');

    debugStyles.forEach(function(item){
        div.style.cssText += item;
    });

    if(from.length > 0)
    {
        objectFrom = 'from: ' + from + '<br><br>';
    }
    else 
    {
        objectFrom = '';
    }

    if(content.length > 0)
    {
        objectContent = 'content: ' + content + '<br><br>';
    }
    else 
    {
        objectContent = '';
    }

    if(type.length > 0)
    {
        objectType = 'type: ' + type + '<br><br>';
    }
    else 
    {
        objectType = '';
    }


    if(count.length > 0)
    {
        objectCount = 'count: ' + count + '<br><br>';
    }
    else 
    {
        objectCount = '';
    }
    

    div.innerHTML += objectFrom;
    div.innerHTML += objectType;
    div.innerHTML += objectCount;
    div.innerHTML += objectContent;

    // debug = document.createTextNode(content);
    debugContainer.appendChild(div);
}








