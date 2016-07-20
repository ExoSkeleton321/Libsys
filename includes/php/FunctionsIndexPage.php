<?php
require 'init.php';

class FunctionsIndexPage{
	public function getMyProfile($user){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			usuarios.usuario_id,
			usuarios.nombre,
			usuarios.apellido_mat,
			usuarios.apellido_pat,
			usuarios.tipoUsuario_id AS tipoId,
			usuarios.tutorial,
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

	public function getNumeroUsuarios(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			COUNT(usuarios.usuario_id)

			FROM usuarios
		");
		$query->execute();

		return $query->fetch();
	}

	public function getNumeroLibros(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			COUNT(libros.libro_id)

			FROM libros
		");
		$query->execute();

		return $query->fetch();
	}

	public function getNumeroClientes(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			COUNT(clientes.cliente_id)

			FROM clientes
		");
		$query->execute();

		return $query->fetch();
	}

	public function getNumeroPedidos(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			COUNT(pedidos.pedido_id)

			FROM pedidos
		");
		$query->execute();

		return $query->fetch();
	}

	public function getNumeroProveedores(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			COUNT(proveedores.proveedor_id)

			FROM proveedores
		");
		$query->execute();

		return $query->fetch();
	}
}