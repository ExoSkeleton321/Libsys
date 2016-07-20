<?php
session_start();
if(isset($_POST['bookId'])){
	require 'FunctionsLibros.php';
	$obj = new FunctionsLibros();

	$deleteUser = $obj->deleteBook($_POST['bookId']);

	if($deleteUser && unlink('../../img/Libros/' . (double) $_POST['bookId'] . '.png')){
		echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Insertado Correctamente.</p>';
	}else{
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo1.</p>';
	}
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo2.</p>';
}