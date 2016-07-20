<?php
require 'init.php';

class FunctionsTelefono{
	public function getAllTipoTel(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT *

			FROM `tipo_tel`
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function insertTipoTel($tipo){
		global $pdo;

		$check = $pdo->prepare("
			SELECT * 
			FROM tipo_tel
			WHERE tipo = :tipo
		");

		$check->execute([
			'tipo' => $tipo
		]);

		if($check->rowCount() > 0){
			return "false1";
		}else{
			$query = $pdo->prepare("
				INSERT INTO tipo_tel(tipo)

				VALUES(:tipo)
			");
			$query->execute([
				'tipo' => $tipo
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}
		}
	}
}