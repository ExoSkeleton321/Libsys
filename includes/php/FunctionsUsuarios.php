<?php
require 'init.php';

class FunctionsUsuarios{
	public function getMyProfile($user){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			usuarios.usuario_id,
			usuarios.nombre,
			usuarios.apellido_mat,
			usuarios.apellido_pat,
			usuarios.password,
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

	public function getUserProfile($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			usuarios.*,
			tipo_usuarios.tipoUsuario_id as tipoUsuarioId,
		    tipo_usuarios.tipo,
		    GROUP_CONCAT(tipo_tel.tipo SEPARATOR '|') AS tipos_tel,
		    GROUP_CONCAT(telefonos_usuarios.telefonoUsuario_id SEPARATOR '|') AS telId,
			GROUP_CONCAT(telefonos_usuarios.telefono SEPARATOR '|') AS telefonos

			FROM usuarios

			INNER JOIN tipo_usuarios
			ON usuarios.tipoUsuario_id = tipo_usuarios.tipoUsuario_id

			LEFT JOIN telefonos_usuarios
			ON usuarios.usuario_id = telefonos_usuarios.usuario_id
		      
	        LEFT JOIN tipo_tel
	        ON tipo_tel.tipoTel_id = telefonos_usuarios.tipoTel_id

	        WHERE usuarios.usuario_id = :id
	      
	        GROUP BY usuarios.usuario_id
		");
		$query->execute([
			'id' => $id
		]);

		return $query->fetch();
	}

	public function getAllUsuarios(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			usuarios.usuario_id,
			usuarios.nombre,
			usuarios.apellido_pat,
		    usuarios.apellido_mat,
		    usuarios.fecha_registro,
		    usuarios.usuario,
		    tipo_usuarios.tipo,
		    GROUP_CONCAT(tipo_tel.tipo SEPARATOR '|') AS tipos_tel,
			GROUP_CONCAT(telefonos_usuarios.telefono SEPARATOR '|') AS telefonos

			FROM usuarios

			INNER JOIN tipo_usuarios
			ON usuarios.tipoUsuario_id = tipo_usuarios.tipoUsuario_id

			LEFT JOIN telefonos_usuarios
			ON usuarios.usuario_id = telefonos_usuarios.usuario_id
		      
	        LEFT JOIN tipo_tel
	        ON tipo_tel.tipoTel_id = telefonos_usuarios.tipoTel_id
	      
	        GROUP BY usuarios.usuario_id

	        ORDER BY usuarios.usuario_id ASC
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function getAllTipoUsuarios(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT *

			FROM `tipo_usuarios`
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function searchForUserByName($name){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			usuarios.usuario_id,
			usuarios.nombre,
			usuarios.apellido_pat,
		    usuarios.apellido_mat,
		    usuarios.fecha_registro,
		    usuarios.usuario,
		    tipo_usuarios.tipo,
		    GROUP_CONCAT(tipo_tel.tipo SEPARATOR '|') AS tipos_tel,
			GROUP_CONCAT(telefonos_usuarios.telefono SEPARATOR '|') AS telefonos

			FROM usuarios

			INNER JOIN tipo_usuarios
			ON usuarios.tipoUsuario_id = tipo_usuarios.tipoUsuario_id

			LEFT JOIN telefonos_usuarios
			ON usuarios.usuario_id = telefonos_usuarios.usuario_id
		      
	        LEFT JOIN tipo_tel
	        ON tipo_tel.tipoTel_id = telefonos_usuarios.tipoTel_id
	      
	        WHERE usuarios.nombre LIKE '" . $name . "%' OR usuarios.apellido_pat LIKE '" . $name . "%' OR usuarios.apellido_mat LIKE '" . $name . "%'
			
			GROUP BY usuarios.usuario_id

	        ORDER BY usuarios.nombre ASC
	    ");
		$query->execute();

		return $query->fetchAll();
	}

	public function searchForUserById($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			usuarios.usuario_id,
			usuarios.nombre,
			usuarios.apellido_pat,
		    usuarios.apellido_mat,
		    usuarios.fecha_registro,
		    usuarios.usuario,
		    tipo_usuarios.tipo,
		    GROUP_CONCAT(tipo_tel.tipo SEPARATOR '|') AS tipos_tel,
			GROUP_CONCAT(telefonos_usuarios.telefono SEPARATOR '|') AS telefonos

			FROM usuarios

			INNER JOIN tipo_usuarios
			ON usuarios.tipoUsuario_id = tipo_usuarios.tipoUsuario_id

			LEFT JOIN telefonos_usuarios
			ON usuarios.usuario_id = telefonos_usuarios.usuario_id
		      
	        LEFT JOIN tipo_tel
	        ON tipo_tel.tipoTel_id = telefonos_usuarios.tipoTel_id
	      
	        WHERE usuarios.usuario_id = :id
			
			GROUP BY usuarios.usuario_id

	        ORDER BY usuarios.nombre ASC
	    ");
		$query->execute([
			'id' => $id
		]);

		return $query->fetchAll();
	}

	public function searchForUserByUsername($username){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			usuarios.usuario_id,
			usuarios.nombre,
			usuarios.apellido_pat,
		    usuarios.apellido_mat,
		    usuarios.fecha_registro,
		    usuarios.usuario,
		    tipo_usuarios.tipo,
		    GROUP_CONCAT(tipo_tel.tipo SEPARATOR '|') AS tipos_tel,
			GROUP_CONCAT(telefonos_usuarios.telefono SEPARATOR '|') AS telefonos

			FROM usuarios

			INNER JOIN tipo_usuarios
			ON usuarios.tipoUsuario_id = tipo_usuarios.tipoUsuario_id

			LEFT JOIN telefonos_usuarios
			ON usuarios.usuario_id = telefonos_usuarios.usuario_id
		      
	        LEFT JOIN tipo_tel
	        ON tipo_tel.tipoTel_id = telefonos_usuarios.tipoTel_id
	      
	        WHERE usuarios.usuario LIKE '". $username . "%'
			
			GROUP BY usuarios.usuario_id

	        ORDER BY usuarios.nombre ASC
	    ");
		$query->execute();

		return $query->fetchAll();
	}

	public function insertUsuario($nombre, $apellido_pat, $apellido_mat, $email, $tel, $tipoTel, $tipoUsuario, $mes, $dia, $anio){
		global $pdo;

		$check = $pdo->prepare("
			SELECT * 
			FROM usuarios
			WHERE correo = BINARY(:email) OR usuario = BINARY(:usuario)
		");
		$check->execute([
			'email'   => $email,
			'usuario' => strtolower(substr($nombre, 0, 3) . substr($apellido_pat, 0, 2) . substr($apellido_mat, 0, 2) . substr($anio, 2, 2))
		]);

		if($check->rowCount() > 0){
			return "false1";
		}else{
			$dob = $anio . "-" . $mes . "-" . $dia;
			$query = $pdo->prepare("
				INSERT INTO 
				usuarios(nombre, apellido_pat, apellido_mat, fecha_nacimiento, tipoUsuario_id, fecha_registro, correo, usuario, password, tutorial)
				VALUES(:nombre, :apellido_pat, :apellido_mat, :fecha_nacimiento, :tipoUsuario, :fecha_registro, :correo, :usuario, :password, 0)
			");
			$query->execute([
				'nombre' 	  	   => ucfirst($nombre),
				'apellido_pat'	   => ucfirst($apellido_pat),
				'apellido_mat' 	   => ucfirst($apellido_mat),
				'fecha_nacimiento' => $dob,
				'tipoUsuario'	   => $tipoUsuario,
				'fecha_registro'   => date("Y-m-d", time()),
				'correo'		   => $email,
				'usuario'		   => strtolower(substr($nombre, 0, 3) . substr($apellido_pat, 0, 2) . substr($apellido_mat, 0, 2) . substr($anio, 2, 2)),
				'password'		   => password_hash($dia . $mes . substr($anio, 2, 2), PASSWORD_BCRYPT)
			]);

			//INSERT TELEPHONE
			$query1 = $pdo->prepare("
				SELECT usuario_id
				FROM usuarios
				WHERE correo = BINARY(:email)
			");
			$query1->execute([
				'email' => $email
			]);
			$prof = $query1->fetch();

			$insertTipo = $pdo->prepare("
				INSERT INTO telefonos_usuarios (tipoTel_id, usuario_id, telefono)
				VALUES(:tipo, :user_id, :tel)
			");
			$insertTipo->execute([
				'tipo' 	  => $tipoTel,
				'user_id' => $prof[0],
				'tel' 	  => $tel
			]);

			if($query && $query1 && $insertTipo){
				return "true";
			}else{
				return "false";
			}
		}
	}

	public function updateUserNoPhone($userId, $nombre, $apellido_pat, $apellido_mat, $email, $tipoUsuario, $anio, $usuarioInicial){
		global $pdo;

		$checkUsuario = $pdo->prepare("
			SELECT COUNT(usuario)
			FROM usuarios
			WHERE usuario = BINARY(:usuario)
		");
		$checkUsuario->execute([
			'usuario' => strtolower(substr($nombre, 0, 3) . substr($apellido_pat, 0, 2) . substr($apellido_mat, 0, 2) . substr($anio, 2, 2)),
		]);
		$check = $checkUsuario->fetch();

		if($check[0] == 0 || $usuarioInicial == strtolower(substr($nombre, 0, 3) . substr($apellido_pat, 0, 2) . substr($apellido_mat, 0, 2) . substr($anio, 2, 2))){
			$query = $pdo->prepare("
				UPDATE usuarios 
				SET nombre = :nombre, apellido_pat = :apellido_pat, apellido_mat = :apellido_mat, tipoUsuario_id = :tipoUsuario,  correo = :correo, usuario = :usuario
				WHERE usuario_id = :userId
			");
			$query->execute([
				'nombre' 	  	   => ucfirst($nombre),
				'apellido_pat'	   => ucfirst($apellido_pat),
				'apellido_mat' 	   => ucfirst($apellido_mat),
				'tipoUsuario'	   => $tipoUsuario,
				'correo'		   => $email,
				'usuario'		   => strtolower(substr($nombre, 0, 3) . substr($apellido_pat, 0, 2) . substr($apellido_mat, 0, 2) . substr($anio, 2, 2)),
				'userId' 		   => $userId
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}	
		}else{
			return "false1";
		}

	}

	public function updateUserWithPhone($userId, $nombre, $apellido_pat, $apellido_mat, $email, $tel, $tipoTel, $tipoUsuario, $anio, $usuarioInicial){
		global $pdo;

		$checkUsuario = $pdo->prepare("
			SELECT COUNT(usuario)
			FROM usuarios
			WHERE usuario = BINARY(:usuario) 
		");
		$checkUsuario->execute([
			'usuario' => strtolower(substr($nombre, 0, 3) . substr($apellido_pat, 0, 2) . substr($apellido_mat, 0, 2) . substr($anio, 2, 2))
		]);
		$check = $checkUsuario->fetch();

		if($check[0] == 0 || $usuarioInicial == strtolower(substr($nombre, 0, 3) . substr($apellido_pat, 0, 2) . substr($apellido_mat, 0, 2) . substr($anio, 2, 2))){
			$query = $pdo->prepare("
				UPDATE usuarios 
				SET nombre = :nombre, apellido_pat = :apellido_pat, apellido_mat = :apellido_mat, tipoUsuario_id = :tipoUsuario,  correo = :correo, usuario = :usuario
				WHERE usuario_id = :userId
			");
			$query->execute([
				'nombre' 	  	   => ucfirst($nombre),
				'apellido_pat'	   => ucfirst($apellido_pat),
				'apellido_mat' 	   => ucfirst($apellido_mat),
				'tipoUsuario'	   => $tipoUsuario,
				'correo'		   => $email,
				'usuario'		   => strtolower(substr($nombre, 0, 3) . substr($apellido_pat, 0, 2) . substr($apellido_mat, 0, 2) . substr($anio, 2, 2)),
				'userId' 		   => $userId
			]);

			//INSERT TELEPHONE
			$checkPhone = $pdo->prepare("
				SELECT COUNT(telefono)
				FROM telefonos_usuarios
				WHERE telefono = BINARY(:telefono) AND usuario_id = BINARY(:userId)
			");
			$checkPhone->execute([
				'telefono' 	=> $tel,
				'userId' 	=> $userId
			]);
			$check = $checkPhone->fetch();

			if($check[0] == 0){
				$insertTipo = $pdo->prepare("
					INSERT INTO telefonos_usuarios (tipoTel_id, usuario_id, telefono)
					VALUES(:tipo, :user_id, :tel)
				");
				$insertTipo->execute([
					'tipo' 	  => $tipoTel,
					'user_id' => $userId,
					'tel' 	  => $tel
				]);

				if($query && $insertTipo){
					return "true";
				}else{
					return "false";
				}
			}else{
				return "false1";
			}	
		}else{
			return "false1";
		}
	}

	public function deleteUser($id){
		global $pdo;

		$query = $pdo->prepare("
			DELETE usuarios, telefonos_usuarios
		    FROM usuarios

		    INNER JOIN telefonos_usuarios 
		    ON usuarios.usuario_id = telefonos_usuarios.usuario_id

		    WHERE usuarios.usuario_id = :id
		");
		$query->execute([
			'id' => $id
		]);

		if($query):
			return true;
		else:
			return false;
		endif;
	}
}