function pxToVw(px)
{
    return (px / window.innerWidth) * 100 + 'vw';
}

function vwToPx(vw)
{
    return (vw / 100) * window.innerWidth + 'px';
}

function pxToEm(px, base=15)
{
    return parseFloat(px)/base + 'em';
}

function getColumnWidth(row, columns, unit, baseFont=15)
{
    styles = window.getComputedStyle(row, null);

    parentWidth = parseInt(styles.getPropertyValue('width'));
    margins = parseInt(styles.getPropertyValue('margin-left')) + parseInt(styles.getPropertyValue('margin-right'));
    padding = parseInt(styles.getPropertyValue('padding-left')) + parseInt(styles.getPropertyValue('padding-right'))

    rowWidth = parentWidth - margins - padding;
    colWidth = (rowWidth / columns);


    // console.log(row, columns, unit, baseFont, colWidth);

    switch(unit)
    {
        case 'vw':
            return pxToVw(colWidth);
        case 'em':
            return pxToEm(colWidth, baseFont);
        default:
            return colWidth;       
    }

}


function collapseCol(col, row)
{
    // console.log(collapseCol.style.width);

    columns = row.children;
    widthGain = (col.style.width - 64) / (columns.length-1);
    col.style.width = 'fit-content';

    for(i=0;i<columns.length;i++)
    {
        if (columns[i] !== col)
        {
            // console.log(columns[i]);
            columns[i].style.width += widthGain;
        }
    }
}

function expandCol(col, row, width)
{
    columns = row.children;
    widthLoss = (col.style.width + width) / (columns.length-1);
    col.style.width = width;

    for(i=0;i<columns.length;i++)
    {
        if (columns[i] !== col)
        {
            console.log(columns[i]);
            columns[i].style.width -= widthLoss;
        }
    }
}


            // expandSidebar(width)
            // {
            //     columns = row.children;
            //     widthLoss = (col.style.width + width) / (columns.length-1);
            //     col.style.width = width;

            //     for(i=0;i<columns.length;i++)
            //     {
            //         if (columns[i] !== col)
            //         {
            //             console.log(columns[i]);
            //             columns[i].style.width -= widthLoss;
            //         }
            //     }
            // }

            // collapseSidebar(width)
            // {
            //     columns = row.children;
            //     widthGain = (col.style.width - 64) / (columns.length-1);
            //     col.style.width = 'fit-content';

            //     for(i=0;i<columns.length;i++)
            //     {
            //         if (columns[i] !== col)
            //         {
            //             // console.log(columns[i]);
            //             columns[i].style.width += widthGain;
            //         }
            //     }
            // }











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