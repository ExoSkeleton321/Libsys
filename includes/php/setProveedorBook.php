<?php
require 'init.php';

if(isset($_POST['bookId'], $_POST['proveedorId'])){
	$query = $pdo->prepare("
		SELECT libro_id
		FROM proveedores
		WHERE proveedor_id = :id
	");
	$query->execute([
		'id' => $_POST['proveedorId']
	]);
	$libros = $query->fetch();

	$libros = explode('|', $libros[0]);

	if(!in_array($_POST['bookId'], $libros)){
		if(count($libros) > 0){
			$newLibro = implode("|", $libros) . "|" . $_POST['bookId'];
		}else{
			$newLibro = $_POST['bookId'];
		}
		
		$query = $pdo->prepare("
			UPDATE proveedores
			SET libro_id = :libros
			WHERE proveedor_id = :id
		");
		$query->execute([
			'libros' => $newLibro,
			'id'     => $_POST['proveedorId']
		]);

		if($query){
			echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Proveedor agregado correctamente.</p>';
		}else{
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
		}
		
	}else{
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, el proveedor ya provee este libro.</p>';
	}
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}