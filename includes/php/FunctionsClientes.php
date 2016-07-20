<?php
require 'init.php';

class FunctionsClientes{
	public function getAllClientes(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			clientes.*,
			tipo_cliente.tipo,
			GROUP_CONCAT(tipo_tel.tipo SEPARATOR '|') AS tipos_tel,
			GROUP_CONCAT(telefono_cliente.telefono SEPARATOR '|') AS telefonos

			FROM clientes

			INNER JOIN tipo_cliente
			ON clientes.tipoCliente_id = tipo_cliente.tipoCliente_id

			LEFT JOIN telefono_cliente
			ON clientes.cliente_id = telefono_cliente.cliente_id
		      
	        LEFT JOIN tipo_tel
	        ON tipo_tel.tipoTel_id = telefono_cliente.tipoTel_id
	      
	        GROUP BY clientes.cliente_id

	        ORDER BY clientes.cliente_id ASC
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function getTipoClientes(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT *

			FROM tipo_cliente
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function insertCliente($nombre, $apellido_pat, $apellido_mat, $email, $tel, $tipoTel, $tipoCliente, $curp, $direccion){
		global $pdo;

		$check = $pdo->prepare("
			SELECT * 
			FROM clientes
			WHERE correo = BINARY(:email) OR CURP = :curp
		");
		$check->execute([
			'email'   => $email,
			'curp'   => $curp
		]);

		if($check->rowCount() > 0){
			return "false1";
		}else{
			$query = $pdo->prepare("
				INSERT INTO 
				clientes(nombre, apellido_pat, apellido_mat, tipoCliente_id, CURP, correo, direccion, fecha_registro)
				VALUES(:nombre, :apellido_pat, :apellido_mat, :tipoCliente_id, :curp, :correo, :direccion, :fecha_registro)
			");
			$query->execute([
				'nombre' 	  	   => ucfirst($nombre),
				'apellido_pat'	   => ucfirst($apellido_pat),
				'apellido_mat' 	   => ucfirst($apellido_mat),
				'tipoCliente_id'   => $tipoCliente,
				'curp'	   		   => strtoupper($curp),
				'correo'	   	   => $email,
				'direccion'	   	   => $direccion,
				'fecha_registro'   => date("Y-m-d", time()),
			]);

			//INSERT TELEPHONE
			$query1 = $pdo->prepare("
				SELECT cliente_id
				FROM clientes
				WHERE correo = BINARY(:email)
			");
			$query1->execute([
				'email' => $email
			]);
			$prof = $query1->fetch();

			$insertTipo = $pdo->prepare("
				INSERT INTO telefono_cliente (tipoTel_id, cliente_id, telefono)
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

	public function searchForCliente($name){
			global $pdo;

			$query = $pdo->prepare("
				SELECT 
				clientes.*,
				tipo_cliente.tipo,
				GROUP_CONCAT(tipo_tel.tipo SEPARATOR '|') AS tipos_tel,
				GROUP_CONCAT(telefono_cliente.telefono SEPARATOR '|') AS telefonos

				FROM clientes

				INNER JOIN tipo_cliente
				ON clientes.tipoCliente_id = tipo_cliente.tipoCliente_id

				LEFT JOIN telefono_cliente
				ON clientes.cliente_id = telefono_cliente.cliente_id
			      
		        LEFT JOIN tipo_tel
		        ON tipo_tel.tipoTel_id = telefono_cliente.tipoTel_id

		        WHERE clientes.nombre LIKE '%" . $name . "%' OR clientes.CURP = :query
		      
		        GROUP BY clientes.cliente_id

		        ORDER BY clientes.cliente_id ASC				
			");
			$query->execute([
				'query' => $name
			]);

			return $query->fetchAll();
		}

		public function getCliente($id){
			global $pdo;

			$query = $pdo->prepare("
				SELECT 
				clientes.*,
				tipo_cliente.tipo,
				GROUP_CONCAT(tipo_tel.tipo SEPARATOR '|') AS tipos_tel,
				GROUP_CONCAT(telefono_cliente.telefono_id SEPARATOR '|') AS telId,
				GROUP_CONCAT(telefono_cliente.telefono SEPARATOR '|') AS telefonos

				FROM clientes

				INNER JOIN tipo_cliente
				ON clientes.tipoCliente_id = tipo_cliente.tipoCliente_id

				LEFT JOIN telefono_cliente
				ON clientes.cliente_id = telefono_cliente.cliente_id
			      
		        LEFT JOIN tipo_tel
		        ON tipo_tel.tipoTel_id = telefono_cliente.tipoTel_id

		        WHERE clientes.cliente_id = :id
		      
		        GROUP BY clientes.cliente_id

		        ORDER BY clientes.cliente_id ASC				
			");
			$query->execute([
				'id' => $id
			]);

			return $query->fetch();
		}

		public function deleteCliente($id){
			global $pdo;

			$query = $pdo->prepare("
				DELETE clientes, telefono_cliente
			    FROM clientes

			    INNER JOIN telefono_cliente
			    ON clientes.cliente_id = telefono_cliente.cliente_id

			    WHERE clientes.cliente_id = :id
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

		public function updateClienteNoPhone($userId, $tipoCliente, $email, $direccion){
			global $pdo;

			$query = $pdo->prepare("
				UPDATE clientes 
				SET tipoCliente_id = :tipoCliente_id, correo = :correo, direccion = :direccion
				WHERE cliente_id = :userId
			");
			$query->execute([
				'tipoCliente_id' => $tipoCliente,
				'correo'	     => $email,
				'direccion' 	 => $direccion,
				'userId' 		 => $userId
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}	
		}

		public function updateClienteWithPhone($userId, $tipoCliente, $email, $direccion, $tel, $tipoTel){
			global $pdo;

			$query = $pdo->prepare("
				UPDATE clientes 
				SET tipoCliente_id = :tipoCliente_id, correo = :correo, direccion = :direccion
				WHERE cliente_id = :userId
			");
			$query->execute([
				'tipoCliente_id' => $tipoCliente,
				'correo'	     => $email,
				'direccion' 	 => $direccion,
				'userId' 		 => $userId
			]);

			//INSERT TELEPHONE
			$checkPhone = $pdo->prepare("
				SELECT COUNT(telefono)
				FROM telefono_cliente
				WHERE (telefono = BINARY(:telefono) AND cliente_id = BINARY(:userId)) OR telefono = BINARY(:telefono)
			");
			$checkPhone->execute([
				'telefono' 	=> $tel,
				'userId' 	=> $userId
			]);
			$check = $checkPhone->fetch();

			if($check[0] == 0){
				$insertTipo = $pdo->prepare("
					INSERT INTO telefono_cliente (tipoTel_id, cliente_id, telefono)
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
		}

		public function checkIfClienteExists($id){
			global $pdo;

			$query = $pdo->prepare("
				SELECT COUNT(cliente_id)
			    FROM clientes

			    WHERE clientes.cliente_id = :id
			");
			$query->execute([
				'id' => $id
			]);

			return $query->fetch();
		}

}