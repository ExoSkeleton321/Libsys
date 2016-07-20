<?php
require 'init.php';

class FunctionsLogIn{
	public function login($user, $pass){
		global $pdo;
		if(empty(trim($user)) or empty(trim($pass))){
			$msg = "<div class='alert alert-warning'>Todos los campos deben ser llenados.</div>";
            return $msg;
		}else{
			$query = $pdo->prepare("
				SELECT * 
				FROM usuarios 
				WHERE correo = BINARY(:user) OR usuario = BINARY(:user)
			");
			$query->execute([
				'user' => $user
			]); 
            $info = $query->fetch();

			if($info){
				$storedPass = $info['password'];

				if(password_verify($pass, $storedPass)){
					$_SESSION['u_up'] = $user;
					header("Location: ".$_SERVER['REQUEST_URI']);
					exit();
				}else{
					$msg = "<div class='alert alert-warning'>Contraseña Invalida.</div>";
	            	return $msg;
				}
			}else{
				$msg = "<div class='alert alert-warning'>Usuario Invalido.</div>";
            	return $msg;
			}
        }
	}
}