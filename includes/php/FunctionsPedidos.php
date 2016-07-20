<?php
require 'init.php';

class FunctionsPedidos{
	public function insertPedido($proveedorId, $clienteId, $anticipo, $total, $pedidos){
		global $pdo;

		if($clienteId !== ""):
			$query = $pdo->prepare("
				INSERT INTO pedidos(libro_id, anticipo, valor_total, cliente_id, fecha_pedido, proveedor_id)
				VALUES(:libros_id, :anticipo, :valor_total, :clienteId, :fecha_pedido, :proveedor_id)
			");
			$query->execute([
				'libros_id'    => $pedidos,
				'anticipo'     => $anticipo,
				'valor_total'  => $total,
				'clienteId'    => $clienteId,
				'fecha_pedido' => date("Y-m-d", time()),
				'proveedor_id' => $proveedorId
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}
		else:
			$query = $pdo->prepare("
				INSERT INTO pedidos(libro_id, anticipo, valor_total, cliente_id, fecha_pedido, proveedor_id)
				VALUES(:libros_id, :anticipo, :valor_total, :clienteId, :fecha_pedido, :proveedor_id)
			");
			$query->execute([
				'libros_id'    => $pedidos,
				'anticipo'     => $anticipo,
				'valor_total'  => $total,
				'clienteId'    => 0,
				'fecha_pedido' => date("Y-m-d", time()),
				'proveedor_id' => $proveedorId
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}
		endif;
	}

	public function getAllPedidos(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT
			pedidos.pedido_id,
			pedidos.libro_id,
			pedidos.anticipo,
			pedidos.valor_total,
			pedidos.fecha_pedido,
			proveedores.nombre,
			clientes.CURP,
			clientes.nombre as nombre_cliente,
			clientes.apellido_pat,
			clientes.apellido_mat

			FROM pedidos

			LEFT JOIN proveedores
			ON pedidos.proveedor_id = proveedores.proveedor_id

			LEFT JOIN clientes
			ON pedidos.cliente_id = clientes.cliente_id

			ORDER BY pedidos.pedido_id ASC
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function getPedidoInfo($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT
			pedidos.pedido_id,
			pedidos.libro_id,
			pedidos.anticipo,
			pedidos.valor_total,
			pedidos.fecha_pedido,
			proveedores.RFC,
			proveedores.nombre,
			clientes.CURP,
			clientes.nombre as nombre_cliente,
			clientes.apellido_pat,
			clientes.apellido_mat

			FROM pedidos

			LEFT JOIN proveedores
			ON pedidos.proveedor_id = proveedores.proveedor_id

			LEFT JOIN clientes
			ON pedidos.cliente_id = clientes.cliente_id

			WHERE pedidos.pedido_id = :id
		");
		$query->execute([
			'id' =>$id
		]);

		return $query->fetch();
	}

	public function deletePedido($id){
		global $pdo;

		$query = $pdo->prepare("
			DELETE
		    FROM pedidos

		    WHERE pedidos.pedido_id = :id
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