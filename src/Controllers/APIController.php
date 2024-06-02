<?php

namespace Controllers\API;

use Controllers\Controller;
use Controllers\API\HTTP\Request;
use Controllers\API\HTTP\Response;
use Override;

class APIController extends Controller
{
    public Request $request;
    public Response $response;

    public function __construct()
    {
        parent::__construct();       
    }


}