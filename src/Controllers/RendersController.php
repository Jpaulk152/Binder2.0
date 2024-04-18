<?php

namespace Controllers;

use Views\View;
use ViewModels\Builders\HtmlBuilder;

class RendersController extends Controller
{
    
    public function index()
    {
        // pull common data to be sent to the view
        $data = $this->getData();


        $this->context->Renders->set(['type'=>'home', 'name'=>'child1']);
        $renders = $this->context->Renders->get()->toList();


        $tables = $this->context->Renders->fetchAll();
 

        $htmlBuilder = new HtmlBuilder();
        for($i=0;$i<count($renders);$i++)
        {
            
            if ($renders[$i]->elementId != 'null')
            {
                $element = $this->context->Elements->resolveRelation($renders[$i]->elementId);
                $content = $this->context->Content->resolveRelation($renders[$i]->contentId);
                $classList = $this->context->ClassLists->resolveRelation($renders[$i]->classListId);

                if($element)
                {
                    $htmlBuilder->buildElement($element->name)
                                ->id(isset($element->title) ? $element->title : '')
                                ->style(isset($element->style) ? $element->style : '')
                                ->tabindex(isset($element->tabindex) ? $element->tabindex : '')
                                ->href(isset($element->href) ? $element->href : '')
                                ->onclick(isset($element->onclick) ? $element->onclick : '');

                    if($element->name == 'img')
                    {
                        $htmlBuilder->alt(isset($element->alt) ? $element->alt : '')
                                    ->width(isset($element->width) ? $element->width : '')
                                    ->height(isset($element->height) ? $element->height : '');

                        if($content)
                        {
                            $htmlBuilder->src(isset($content->content) ? $content->content : '');
                        }
                    }
                    else
                    {
                        if($content)
                        {
                            $htmlBuilder->content(isset($content->content) ? $content->content : '');
                        }
                    }

                    if($classList)
                    {
                        $htmlBuilder->classList(isset($classList->list) ? $classList->list : '');
                    }


            }


            echo $htmlBuilder->create();

        }

        


        // $htmlBuilder->buildElement();



        // array(
//             0 => array( 'content' => '', 'classList' => '', 'element' => '' )
        // )

        

        // add an html template
        // $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        
        // $data['template']['data'] = ['tables' => $newContent];

        $view = new View($data);

        $view->render();
    }


}

    public function detail()
    {
        $data = $this->getData();

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
        $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_URL);

        $this->context->Renders->set(['id'=>$id, 'name'=>$name]);

        $renders = $this->context->Renders->fetchAll();

        // add an html template
        $data['template']['page'] = 'templates\tables.php';

        // add data to be displayed in template
        
        $data['template']['data'] = ['tables' => $renders];

        $view = new View($data);

        $view->render();
    }
    
}