<?php
require 'init.php';

class FunctionsProveedores{
	public function getAllProveedores(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT
			proveedores.*,
			GROUP_CONCAT(direccion_proveedor.calle SEPARATOR '|') AS calles,
			GROUP_CONCAT(direccion_proveedor.calle_numero SEPARATOR '|') AS calles_numeros,
			GROUP_CONCAT(direccion_proveedor.codigo_postal SEPARATOR '|') AS codigo_postales,
			GROUP_CONCAT(estados.estado SEPARATOR '|') AS estados,
			GROUP_CONCAT(municipios.municipio SEPARATOR '|') AS municipios,
			GROUP_CONCAT(localidades.localidad SEPARATOR '|') AS localidades

			FROM proveedores

			INNER JOIN direccion_proveedor
			ON direccion_proveedor.proveedor_id = proveedores.proveedor_id

			INNER JOIN estados
			ON direccion_proveedor.estado_id = estados.estado_id

			INNER JOIN municipios
			ON direccion_proveedor.municipio_id = municipios.municipio_id

			INNER JOIN localidades
			ON direccion_proveedor.localidad_id = localidades.localidad_id

			GROUP BY proveedores.proveedor_id

			ORDER BY proveedores.RFC ASC
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function getAllEstados(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT *
			FROM estados
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function insertProveedor($rfc, $nombre, $tel, $web, $calle, $numero_calle, $estado_id, $municipio_id, $localidad_id, $cp){
		global $pdo;

		$check = $pdo->prepare("
			SELECT proveedor_id
			FROM proveedores
			WHERE RFC = BINARY(:rfc)
		");
		$check->execute([
			'rfc' => $rfc
		]);
		$count = $check->rowCount();

		if($count > 0):
			return 'false1';
		else:
			$query = $pdo->prepare("
				INSERT INTO proveedores(RFC, nombre, telefono, sitio_web)
				VALUES(:rfc, :nombre, :tel, :sitio_web)
			");
			$query->execute([
				'rfc' 		=> strtoupper($rfc),
				'nombre' 	=> $nombre,
				'tel' 		=> $tel,
				'sitio_web' => $web
			]);

			//Insert direccion
			$query2 = $pdo->prepare("
				SELECT proveedor_id
				FROM proveedores 
				WHERE RFC = BINARY(:rfc)
			");
			$query2->execute([
				'rfc' => strtoupper($rfc)
			]);
			$provId = $query2->fetch();

			$insertDir = $pdo->prepare("
				INSERT INTO direccion_proveedor(proveedor_id, calle, calle_numero, codigo_postal, estado_id, municipio_id, localidad_id)
				VALUES(:id, :calle, :numero, :cp, :estado_id, :municipio_id, :localidad_id)
			");
			$insertDir->execute([
				'id' 		   => $provId['proveedor_id'],
				'calle' 	   => $calle, 
				'numero'	   => $numero_calle,
				'cp' 		   => $cp,
				'estado_id'    => $estado_id,
				'municipio_id' => $municipio_id,
				'localidad_id' => $localidad_id
			]);

			if($query && $query2 && $insertDir){
				return "true";
			}else{
				return 'false';
			}			
		endif;
	}

	public function getProveedorInfo($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT
			proveedores.*,
			GROUP_CONCAT(direccion_proveedor.calle SEPARATOR '|') AS calles,
			GROUP_CONCAT(direccion_proveedor.calle_numero SEPARATOR '|') AS calles_numeros,
			GROUP_CONCAT(direccion_proveedor.codigo_postal SEPARATOR '|') AS codigo_postales,
			GROUP_CONCAT(estados.estado SEPARATOR '|') AS estados,
			GROUP_CONCAT(municipios.municipio SEPARATOR '|') AS municipios,
			GROUP_CONCAT(localidades.localidad SEPARATOR '|') AS localidades

			FROM proveedores

			INNER JOIN direccion_proveedor
			ON direccion_proveedor.proveedor_id = proveedores.proveedor_id

			INNER JOIN estados
			ON direccion_proveedor.estado_id = estados.estado_id

			INNER JOIN municipios
			ON direccion_proveedor.municipio_id = municipios.municipio_id

			INNER JOIN localidades
			ON direccion_proveedor.localidad_id = localidades.localidad_id
			
			WHERE proveedores.proveedor_id = :id

			GROUP BY proveedores.proveedor_id
		");
		$query->execute([
			'id' => $id
		]);

		return $query->fetch();

	}

	public function deleteProveedor($id){
		global $pdo;

		$query = $pdo->prepare("
			DELETE proveedores, direccion_proveedor
		    FROM proveedores

		    INNER JOIN direccion_proveedor 
		    ON direccion_proveedor.proveedor_id = proveedores.proveedor_id

		    WHERE proveedores.proveedor_id = :id
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