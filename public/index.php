<?php
// require_once('../HC-DEV/includes/functions.core.php');
require_once('../src/config.php');

set_include_path(config::src_root());

// die(config::src_root());


require_once('Autoloader.php');

$router = require 'Routes/index.php';
