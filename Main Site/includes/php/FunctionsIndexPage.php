<?php
require 'init.php';

class FunctionsIndexPage{
	public function getMyProfile($user){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			usuarios.nombre,
			usuarios.apellido_mat,
			usuarios.apellido_pat,
			usuarios.tipoUsuario_id AS tipoId,
			tipo_usuarios.tipo

			FROM usuarios 

			INNER JOIN tipo_usuarios
			ON usuarios.tipoUsuario_id = tipo_usuarios.tipoUsuario_id

			WHERE correo = BINARY(:user) OR usuario = BINARY(:user)
		");
		$query->execute([
			'user' => $user
		]);

		return $query->fetch();
	}
}