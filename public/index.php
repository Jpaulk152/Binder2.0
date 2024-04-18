<?php

// phpinfo();

// die();

require_once('../src/config.php');

set_include_path(config::src_root());


require_once('Autoloader.php');

$router = require 'Routes/index.php';

?>
