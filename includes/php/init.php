<?php
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	try{
		define("HOST", "localhost");
		define("DB", "libreria");
		define("USER", "root");
		define("PASS", "");
		$pdo = new PDO("mysql:host=".constant("HOST").";dbname=".constant("DB")."", constant("USER"), constant("PASS"));
	}catch(PDOException $error){
		exit("Error conectandose a la base de datos.");
	}
?>