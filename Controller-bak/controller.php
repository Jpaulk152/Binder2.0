<?php

// Holds data like $baseUrl etc.
// include '../config.php';
require_once('../Autoloader.php');

$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$requestString = substr($requestUrl, strlen($baseUrl));

$urlParams = explode('/', $requestString);

// TODO: Consider security (see comments)
$controllerName = ucfirst(array_shift($urlParams)).'Controller';
$actionName = strtolower(array_shift($urlParams)).'Action';

// Here you should probably gather the rest as params

// Call the action
$controller = new $controllerName;
$controller->$actionName();