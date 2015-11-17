<?php

function slot($name,$default_value) {
	if(isset($_SESSION['slots'][$name]))
		echo $_SESSION['slots'][$name];
	else
		echo $default_value;
}

function secure() {
	$_SESSION['last_url'] = $_SERVER['REQUEST_URI'];
	$user = new user();
	if (!$user->isLoggedIn()) {
		header('Location: ' . LOGIN_PATH);
	}
	
	return $user;
}

function partial($controller,$action,$args) {
	foreach($args as $name => $arg) {
		$$name = $arg;
	}
	include(BASE_PATH . '/view/' . $controller . '/_' . $action . '.php');
}