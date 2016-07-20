<?php
	session_start();
	require 'FunctionsIndexPage.php';
	require 'init.php';
	$obj = new FunctionsIndexPage();

	//Get my profile.
	$profile = $obj->getMyProfile($_SESSION['u_up']);

	$query = $pdo->prepare("
		UPDATE usuarios
		SET tutorial = 1
		WHERE usuario_id = :id
	");

	$query->execute([
		'id' => $profile['usuario_id']
	]);