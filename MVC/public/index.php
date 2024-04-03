<?php

require_once('../src/config.php');
set_include_path(config::app_root());

require_once('Autoloader.php');

$router = require 'Routes/index.php';


?>
