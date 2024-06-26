<?php

namespace Controllers;

use Views\Page;
use Views\Layout;
use Views\View;
use Views\Elements\Element;
use Views\Elements\Panel;
use Views\Elements\Navbar;
use Views\Elements\Sidebar;
use Views\Elements\Card;
use Views\Elements\Gauge;
use Views\Elements\Button2;
use Views\Elements\Dropdown;
use Views\Elements\Expander;
use Views\Elements\Image;
use Views\Elements\Form;
use Views\Elements\Table;

use \utilities as u;

class HomeController extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        // echo '<script src="public/js/debug.js"></script>';
        // echo '<body></body>';

        $table = $this->dbContext->page_table;

        // $page = $this->dbContext->page_table->get(['page_title', 'page_id'])->firstOrDefault();
        $buttons = [

            new Button2('menu', "appMenu(".$this->toJSON(['id'=>'afjrotc_css']).", `main`)"),
            new Button2('Dashboard', "location.href='dash'"),
            new Button2('Index', "location.href='index'"),
            new Button2('Examples', "location.href='examples'"),

        ];

        $pages = $table->set(['page_parent'=>'none', 'page_status'=>'true', 'page_inmenu'=>'true'])
            ->orderBy(['page_title'])
            ->get(['page_title', 'page_id'])
            ->toArray();

        $pages[0] =  new Button2(
            name: $pages[0]['page_title'], 
            function1: 'appMenu('.$this->toJSON(['id'=>$pages[0]['page_id']]).', `side`)', 
            function2: 'appPageContent('.$this->toJSON(['id'=>$pages[0]['page_id']]).', `main`)',

        );


        // foreach($pages as &$page)
        // {
        //     $page = new Button2(
        //         name: $page['page_title'], 
        //         function1: 'appMenu('.$this->toJSON(['id'=>$page['page_id']]).', `side`)', 
        //         function2: 'appPageContent('.$this->toJSON(['id'=>$page['page_id']]).', `content`)',

        //     );
        // }

        $buttons = array_merge($pages, $buttons);
        $nav = new Navbar(...$buttons);

        $bio = new View(
            element1: new Image('../public/resources/BioCantwell.JPG'), 
            element2: '<p>Brigadier General Houston R. Cantwell<br><em>Commander, Holm Center </em>&nbsp;</p><br><p><a href="https://www.af.mil/About-Us/Biographies/Display/Article/2298672/houston-r-cantwell/" target="_blank" rel="noopener" style="color: #0087ff">Biography</a></p>',
        );

        $intro = new View(
            element1: '<p>Welcome to Jeanne M. Holm Center for Officer Accessions and Citizen Development. Our mission is straight-forward: <strong>“We build leaders.”</strong> The Holm Center vision of the future to sustain “a diverse culture of leadership development focused on Continuous Learning, Enthusiasm, Pride, Compliance and Tradition” is what motivates us every day. <br><br>Holm Center provides coordinated leadership and policy direction for the Air Force\'s officer recruiting, training, and commissioning programs at Officer Training School and at Air Force ROTC detachments at 145 universities. About 80 percent of the new officers who enter the Air Force each year come through one of our two programs. Our staff also manages, supports and develops curriculum to train tomorrow\'s Air and Space Forces officers. <br><br>Holm Center also directs the Air Force\'s high school citizenship training program - Air Force Junior ROTC. We oversee 870 Air Force Junior ROTC units on high school campuses around the world. The aim of that program is to build better citizens for America. We do that today for over 85,000 cadets.<br><br>For More Info Call Toll Free 1-800-522-0033 <br>(Holm Center ext 7087, AFJROTC ext 7513, AFROTC ext 2091)<br>For questions related to this site or other Holm Center sites, Call (334) 953-3050 or email <a href=\"mailto:holmcenter.wings.support@us.af.mil\" style="color: #0087ff">holmcenter.wings.support@us.af.mil&nbsp;</a>&nbsp;</p>',
            
        );



        

        $main = new View(
            $welcome = new Panel(
                name: 'Welcome to the Jeanne M. Holm Center for Officer Accessions & Citizen Development.', 
                row1: [
                    new View(
                        element1: new Image('../public/resources/BioCantwell.JPG'), 
                        element2: '<p>Brigadier General Houston R. Cantwell<br><em>Commander, Holm Center </em>&nbsp;</p><br><p><a href="https://www.af.mil/About-Us/Biographies/Display/Article/2298672/houston-r-cantwell/" target="_blank" rel="noopener" style="color: #0087ff">Biography</a></p>',
                    ), 
                    new View(
                        element1: '<p>Welcome to Jeanne M. Holm Center for Officer Accessions and Citizen Development. Our mission is straight-forward: <strong>“We build leaders.”</strong> The Holm Center vision of the future to sustain “a diverse culture of leadership development focused on Continuous Learning, Enthusiasm, Pride, Compliance and Tradition” is what motivates us every day. <br><br>Holm Center provides coordinated leadership and policy direction for the Air Force\'s officer recruiting, training, and commissioning programs at Officer Training School and at Air Force ROTC detachments at 145 universities. About 80 percent of the new officers who enter the Air Force each year come through one of our two programs. Our staff also manages, supports and develops curriculum to train tomorrow\'s Air and Space Forces officers. <br><br>Holm Center also directs the Air Force\'s high school citizenship training program - Air Force Junior ROTC. We oversee 870 Air Force Junior ROTC units on high school campuses around the world. The aim of that program is to build better citizens for America. We do that today for over 85,000 cadets.<br><br>For More Info Call Toll Free 1-800-522-0033 <br>(Holm Center ext 7087, AFJROTC ext 7513, AFROTC ext 2091)<br>For questions related to this site or other Holm Center sites, Call (334) 953-3050 or email <a href=\"mailto:holmcenter.wings.support@us.af.mil\" style="color: #0087ff">holmcenter.wings.support@us.af.mil&nbsp;</a>&nbsp;</p>',
                    )        
                ], 
                row2: ['<p>NOTE:&nbsp; ROTC Cadets needing technical assistance are advised to work with detachment.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>']
            )
        );
        $main->addAttributes(['id'=>'main', 'class'=>'w3-rest', 'style'=>'height:100%;overflow:auto;padding:2em;']);

        
        $content = new View($main);
        $content->addAttributes(['class'=>'w3-row', 'style'=>'position:relative; height:100%;']);

        $this->page = new Page($nav, $content);
        $this->page->title='Home';
    }

    public function index()
    {
        $this->page->render();
    }
    
    function redirect($uri)
    {
        // $msg = '<p style="color:red">No route found for URI: ' . $uri . '</p>';
        // $this->page->layout->setView(new View('main', $msg));

        // $this->index();
    }

    function insert($parameters)
    {
        extract($parameters);

        // new Response($parameters, 300);
        // return;

        // $view = new View($id, $entity);
        // $view->bundle = $bundle;


        // echo print_r($view, true);

        // $this->page->layout->setView($view);

        // $this->index();
    }

}


