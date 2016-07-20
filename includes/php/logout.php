<?php
	session_start();
	require 'init.php';
	// Unset Cookies
	if (isset($_SERVER['HTTP_COOKIE'])) {
	    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
	    foreach($cookies as $cookie) {
	        $parts = explode('=', $cookie);
	        $name = trim($parts[0]);
	        setcookie($name, '', time()-1000);
	        setcookie($name, '', time()-1000, '/');
	    }
	}
	//Destroy sessions
	session_destroy();
	//Redirect
	header("Location: ../../");
	exit();