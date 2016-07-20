<?php 
	error_reporting(1);
	require 'FunctionsLibros.php';
	require 'FunctionsClientes.php';
	require 'FunctionsVentas.php';
	$obj  = new FunctionsLibros();
	$obj2 = new FunctionsClientes();
	$obj3 = new FunctionsVentas();

	if(isset($_POST['books']) && $_POST['books']){
		$books = $_POST['books'];
		
		if($_POST['clienteId'] !== "" && $obj2->checkIfClienteExists($_POST['clienteId'])[0] > 0):
			foreach($books as $book):
				$parts = explode('|', $book);
				$existencias = $obj->getExistenciasLibros($parts[0]);

				if($parts[1] <= $existencias[0]){
					//Insert venta
					$insert = $obj3->insertVenta($parts[0], $_POST['clienteId'], $parts[2], date("Y-m-d"));
					$updateExistencias = $obj->updateExistencias($parts[0], $parts[1]);
				}else{
					echo '<p class="responseVentaRealizada" style="font-size: 20px;">
							Venta del libro <b>' . $obj->getNameLibro($parts[0])[0] . '</b> no pudo ser completada por falta de existencias.
						  </p>';
				}
			endforeach;
		else:
			//Insert venta as no cliente
			foreach($books as $book):
				$parts = explode('|', $book);
				$existencias = $obj->getExistenciasLibros($parts[0]);

				if($parts[1] <= $existencias[0]){
					//Insert venta
					$insert = $obj3->insertVenta($parts[0], "0", $parts[2], date("Y-m-d"));
					$updateExistencias = $obj->updateExistencias($parts[0], $parts[1]);
				}else{
					echo '<p class="responseVentaRealizada" style="font-size: 20px;">
							Venta del libro <b>' . $obj->getNameLibro($parts[0])[0] . '</b> no pudo ser completada por falta de existencias.
						  </p>';
				}
			endforeach;
		endif;
	}else{
		echo 'No se encontraron libros para vender.';
	}
 ?>