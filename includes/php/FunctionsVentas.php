<?php
require 'init.php';

class FunctionsVentas{
	public function getAllVentas(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT COUNT(venta_id) AS numVentas, fecha_venta, SUM(valor_venta)
			FROM ventas
			WHERE fecha_venta BETWEEN str_to_date('2015-01-01','%Y-%m-%d') AND str_to_date('" . date("Y-m-d") . "','%Y-%m-%d')
			GROUP BY fecha_venta
			ORDER BY fecha_venta DESC
			LIMIT 10
		");

		$query->execute();

		return $query->fetchAll();
	}

	public function getAllVentasBetween($fecha1, $fecha2){
		global $pdo;

		$query = $pdo->prepare("
			SELECT COUNT(venta_id) AS numVentas, fecha_venta, SUM(valor_venta)
			FROM ventas
			WHERE fecha_venta BETWEEN str_to_date('" . $fecha1 . "','%Y-%m-%d') AND str_to_date('" . $fecha2 . "','%Y-%m-%d')
			GROUP BY fecha_venta
			ORDER BY fecha_venta DESC
		");

		$query->execute();

		return $query->fetchAll();
	}

	public function insertVenta($libroId, $clienteId, $valorVenta, $fechaVenta){
		global $pdo;

		$query = $pdo->prepare("
			INSERT INTO ventas (libro_id, cliente_id, valor_venta, fecha_venta)
			VALUES(:libroId, :clienteId, :valorVenta, :fechaVenta)
		");
		$query->execute([
			'libroId'     => $libroId,
			'clienteId'   => $clienteId,
			'valorVenta'  => $valorVenta,
			'fechaVenta' => $fechaVenta
		]);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	
}