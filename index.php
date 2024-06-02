<?php



require_once('src/config.php');

require_once('src/Autoloader.php');

global $tabIndex, $style;

$tabIndex = 1;
$style = 'Default';

$router = require 'src/Routes/index.php';
