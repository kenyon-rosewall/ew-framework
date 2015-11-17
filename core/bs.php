<?php

require_once('bootstrap.class.php');
$bs = new bootstrap();

// start session
$bs->startSession();

// include libraries
$bs->includeLibraries();

// load config
$bs->loadConfig();

// set variables
$bs->loadRequest($_REQUEST, $_FILES, $_SESSION);

// read route
$route = $bs->readRoute('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

// load controller
$data = $bs->loadController($route);

// display view
$bs->displayView($data);