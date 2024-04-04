<h1>Welcome to the welcome page!</h1>

<?php

class Welcome extends View
{
    public function __construct()
    {
        $this->body = '<h1>Welcome to the welcome page!</h1>';
        echo $this->render();
    }
}